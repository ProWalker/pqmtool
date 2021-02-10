<?php

namespace PQMTool\Classes;

use function PQMTool\Lib\getQuestionTypes;
use function PQMTool\Lib\isAnswer;
use function PQMTool\Lib\parseAnswer;
use function PQMTool\Lib\createQuestionBuilder;

class PQMTool
{
    function parseQuestions(array $col): array
    {
        $questions = [];
        $typeOfQuestions = getQuestionTypes();
        // Default question type
        $type = 'multichoice';
        $questionData = ['data' => [], 'answer' => '']; 
        foreach ($col as $line)
        {
            if (empty($line)) {
                continue;
            }
            $line = trim($line);
            // If this type of question
            if (in_array(strtolower($line), $typeOfQuestions)) {
                $type = $line;
                continue;
            }
            if (!isAnswer($line)) {
                $questionData['data'][] = $line;
            } else {
                $answer = parseAnswer($line);
                $questionData['answer'] = $answer;
                $builder = createQuestionBuilder($type, $questionData);
                $questions[] = $builder->makeQuestion();
                $builder->reset();
                $questionData['data'] = [];
                $questionData['answer'] = '';
            }
        }
        return $questions;
    }

    function questionsToXml(array $questions): String
    {
        $xw = new \XMLWriter();
        $xw->openMemory();
        $xw->startDocument("1.0");
        $xw->writeComment("Generated with pqmtool");
        $xw->startElement("quiz");
        $xw->startElement("question");
        $xw->writeAttribute("type", "category");
        $xw->startElement("category");
        $xw->startElement("text");
        $xw->text("__Default category__");
        $xw->endElement(); // End text element
        $xw->endElement(); // End category element
        $xw->endElement(); // End question element
        foreach ($questions as $number => $question) {
            if ($question instanceof MultichoiceQuestion) {
                $printer = new MultichoiceQuestionXmlPrinter($question, $number);
            } else {
                $printer = new ShortanswerQuestionXmlPrinter($question, $number);
            }
            $xw->writeRaw($printer->output());
        }
        $xw->endElement();
        $xw->writeComment("Generated with pqmtool");
        $xw->endDocument();
        return $xw->outputMemory();
    }
}