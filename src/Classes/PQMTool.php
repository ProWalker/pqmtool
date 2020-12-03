<?php

namespace PQMTool\Classes;

// include __DIR__ . '/../Lib/parse.php';

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
}