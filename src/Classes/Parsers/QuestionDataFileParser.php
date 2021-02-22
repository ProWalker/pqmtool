<?php

/**
 * This class is responsible for parsing file to data for application.
 */

namespace PQMTool\Classes\Parsers;

use PQMTool\Classes\Questions\QuestionData;
use function PQMTool\Lib\getQuestionTypes;
use function PQMTool\Lib\isAnswer;
use function PQMTool\Lib\parseAnswer;
use function PQMTool\Lib\parseFileToArray;

class QuestionDataFileParser implements IQuestionDataParser
{
    public function parse(string $path): array
    {
        $result = [];
        $fileToArray = parseFileToArray($path);
        $data = new QuestionData();
        $typeOfQuestions = getQuestionTypes();
        // Default question type
        $questionType = 'multichoice';

        foreach ($fileToArray as $line)
        {
            $line = trim($line);
            if (empty($line))
            {
                continue;
            }
            // If this type of question
            if (in_array(strtolower($line), $typeOfQuestions))
            {
                $questionType = $line;
                continue;
            }
            if (empty($data->getQuestionText()))
            {
                $data->setQuestionText($line);
            }
            elseif (!isAnswer($line))
            {
                $data->addAnswerVariant($line);
            }
            else {
                $answer = parseAnswer($line);
                $data->setAnswer($answer);
                $data->setQuestionType($questionType);
                $result[] = $data;
                $data = new QuestionData();
            }
        }

        return $result;
    }
}