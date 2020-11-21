<?php

namespace Nik\Lib;

require __DIR__ . '/../classes//Question.php';
require __DIR__ . '/../classes/MultichoiceQuestion.php';
require __DIR__ . '/../classes/QuestionToXml.php';

use Nik\Classes\Question;
use Nik\Classes\MultichoiceQuestion;

/**
 * Usefull functions for parsing questions
 */

function parseFileToArray($file): array
{
    // To do: create FileNotExist exception.
    if (!file_exists($file)) {
        throw new \Exception("File does not exist!");
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
    $question = null;   
    foreach ($file as $line)
    {
        if (empty($line)) {
            continue;
        }
        // If this type of question
        if (in_array($line, $typeOfQuestions)) {
            $type = $line;
        }
        if (is_null($question)) {
            $question = createQuestion($type);
        }
        if (!isAnswer($line)) {
            if ($question->getText() == '') {
                $question->setText($line);
            } else {
                $question->setAnswerVariant($line);
            }
        } else {
            $answers = parseAnswer($line, $type);
            $question->setAnswers($answers);
            // This is problem, need to clone object or something. Better use Builder pattern.
            // To do: use Builder pattern
            $copyOfQuestion = clone $question;
            $questions[] = $copyOfQuestion;
            $question = null;
        }
    }

    return $questions;
}

// To do: Needs to replace for Builder pattern
// To do: deprecate this function
function createQuestion(String $type): Question
{
    $question = 'Nik\Classes\\' . ucfirst($type) . 'Question';
    return new $question;
}

function createQuestionBuilder(String $type): QuestionBuilder
{
    $builder = 'Nik\Classes\\' . ucfirst($type) . 'QuestionBuilder';
    return new $builder;
}

function isAnswer(String $line): bool
{
    return strpos($line, 'Answer:') !== false;
}

/**
 * To do: Need to take out the code for parsing answer.
 * It's responsibility each question class for proper
 * processing right answers.  
 */ 
function parseAnswer(String $line, String $type): array
{
    $index = strpos($line, ':');
    $answerStr = substr($line, $index + 1);
    $answer = trim($answerStr);
    if (strlen($answer) == 0) {
        throw new \Exception("Answer is absent.");
    }
    switch ($type) {
        case Question::MULTICHOICE_TYPE:
            $delimiter = ',';
        case Question::SHORT_TYPE:
            $delimiter = '/';
    }
    if (strlen($answer) == 1) {
        $answer = array($answer);
    } else {
        $answer = explode($delimiter, $answer);
    }
    return $answer;
}