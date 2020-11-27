<?php

/**
 * Basic class for build question
 */

namespace PQMTool\Classes;

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
        return $this->answer;
    }

    protected function validation()
    {
        $data = $this->getQuestionData();
        if (count($data) == 0) {
            throw new \Exception("Error: Missing data for the question.");
        }
        $answer = $this->getQuestionAnswer();
        if (strlen($answer) == 0) {
            throw new \Exception("Error: Missing answer for the question.");
        }
    }

    abstract function isAnswerValid(String $answer): bool;

    function reset()
    {
        $this->data = [];
        $this->answer = "";
    }
}