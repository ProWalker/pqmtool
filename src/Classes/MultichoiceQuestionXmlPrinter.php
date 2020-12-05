<?php

/**
 * This class with template method is responsible for output question data
 * to xml form.
 */

namespace PQMTool\Classes;

use PQMTool\Classes\Question;
use PQMTool\Classes\QuestionPrinter;

class MultichoiceQuestionXmlPrinter extends QuestionPrinter
{
    public function output(): String
    {
        $type = $this->question->getType();
        $xw = new \XMLWriter();
        $xw->openMemory();
        $xw->writeComment("Question entry {$this->numberOfQuestion}");
        $xw->startElement("question");
        $xw->writeAttribute("type", $type);
        $xw->startElement("name");
        $xw->startElement("text");
        $xw->writeCData("__Question {$this->numberOfQuestion}");
        $xw->endElement(); // end text element
        $xw->endElement(); // end name element
        $rawData = parent::output();
        $xw->writeRaw($rawData);
        $xw->startElement("shuffleanswers");
        $xw->text("0");
        $xw->endElement(); // end shuffleanswers element
        $xw->startElement("single");
        $xw->text("false");
        $xw->endElement(); // end single element
        $xw->startElement("answernumbering");
        $xw->text("123");
        $xw->endElement(); // end answernumbering element
        $xw->endElement(); // end question element
        return $xw->outputMemory();
    }

    function printText(): String
    {
        $xw = new \XMLWriter();
        $xw->openMemory();
        $xw->startElement("questiontext");
        $xw->writeAttribute("format", "html");
        $xw->startElement("text");
        $xw->writeCData($this->question->getText());
        $xw->endElement();
        $xw->endElement();
        return $xw->outputMemory();
    }

    function printAnswer(): String
    {
        $answerVariants = $this->question->getAnswerVariants();
        $answers = $this->question->getAnswers();
        $fraction = 100 / count($answers);
        $xw = new \XMLWriter();
        $xw->openMemory();
        foreach ($answerVariants as $key => $value) {
            $xw->startElement("answer");
            $xw->writeAttribute("fraction", in_array($key, $answers) ? $fraction : "0");
            $xw->startElement("text");
            $xw->writeCData($value);
            $xw->endElement();
            $xw->endElement();
        }
        return $xw->outputMemory();
    }
}