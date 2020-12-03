<?php

/**
 * Basic class for build question
 */

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;
use function PQMTool\Lib\stringIsEmpty;

abstract class QuestionBuilder
{
    // This may include text questions and answer variants
    protected $data = [];
    protected $answer = "";

    function __construct(array $data, String $answer) {
        $this->data = $data;
        $this->answer = $answer;
    }

    // Basic interface
    abstract function makeQuestion(): Question;

    protected function getQuestionData(): array
    {
        return $this->data;
    }

    protected function getQuestionAnswer(): String
    {
        return trim($this->answer);
    }

    protected function validation()
    {
        $data = $this->getQuestionData();
        if (count($data) == 0) {
            throw new QuestionFormatException("Error: Missing data for the question.");
        }
        if (stringIsEmpty($data[0])) {
            throw new QuestionFormatException("Error: Missing question text.");
        }
        $answer = $this->getQuestionAnswer();
        if (stringIsEmpty($answer)) {
            throw new QuestionFormatException("Error: Missing answer for the question.");
        }
    }

    abstract function isAnswerValid(String $answer): bool;

    function reset()
    {
        $this->data = [];
        $this->answer = "";
    }
}