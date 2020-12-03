<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;

/**
 * Basic class for question. This is abstraction for a question.
 * All work for validation data takes place in question builders.
 */
class Question {
    // Type of question
    protected String $type = "basic";

    // This is text of question
    protected String $text = "";

    // Right answers for the question
    protected array $answers = [];

    function setText(String $text)
    {
        if ($text == "") {
            throw new QuestionFormatException("The text must not be empty line");
        }
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

    function getType(): String
    {
        return $this->type;
    }

}