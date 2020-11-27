<?php

namespace PQMTool\Classes;

/**
 * Basic class for question
 */
abstract class Question {
    // Type of question
    protected String $type = "basic";

    // This is text of question
    protected String $text = "";

    // Right answers for the question
    protected array $answers = [];

    function setText(String $text)
    {
        $this->text = $text;
    }

    abstract function setAnswers(String $answers);

    function getAnswers(): array
    {
        return $this->answers;
    }

    function getText(): String
    {
        return $this->text;
    }

    function getType(): String
    {
        return $this->type;
    }

}