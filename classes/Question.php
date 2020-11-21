<?php

namespace Nik\Classes;

/**
 * Basic class for question
 */
class Question {
    // Basic constants
    const MULTICHOICE_TYPE = "multichoice";
    const SHORT_TYPE = "shortquestion";

    // This is text of question
    protected $text = "";

    // Right answers for the question
    protected array $answers = [];

    function setText(String $text)
    {
        $this->text = $text;
    }

    function setAnswers(array $answers)
    {
        $this->answers = $answers;
    }

    function getAnswers(): array
    {
        return $this->answers;
    }

    function getText(): String
    {
        return $this->text;
    }

}