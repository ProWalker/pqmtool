<?php

namespace Nik\Lib;

use Nik\Classes\Question;
use Nik\Classes\MultichoiceQuestion;
use Nik\Classes\Exceptions;

/**
 * Usefull functions for parsing questions
 */

function parseFileToArray($file): array
{
    if (!file_exists($file)) {
        throw new FileNotExistException();
    }
    $file = file_get_contents($file);
    return explode("\n", $file);
}

function parseQuestions(array $file): array
{
    $questions = [];
    $typeOfQuestions = [Question::MULTICHOICE_TYPE, Question::SHORT_TYPE];
    // Default question type
    $type = Question::MULTICHOICE_TYPE;
    $questionData = ['data' => [], 'answer' => '']; 
    foreach ($file as $line)
    {
        if (empty($line)) {
            continue;
        }
        // If this type of question
        if (in_array(strtolower($line), $typeOfQuestions)) {
            $type = $line;
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

// Unused
function createQuestion(String $type): Question
{
    $question = 'Nik\Classes\\' . ucfirst($type) . 'Question';
    return new $question;
}

function createQuestionBuilder(String $type, array $questionData)
{
    $builder = 'Nik\Classes\\' . ucfirst($type) . 'QuestionBuilder';
    return new $builder($questionData['data'], $questionData['answer']);
}

function isAnswer(String $line): bool
{
    return strpos($line, 'Answer:') !== false;
}

function parseAnswer(String $line): String
{
    $answer = explode(':', $line)[1];
    return trim($answer);
}