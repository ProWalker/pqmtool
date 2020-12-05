<?php

/**
 * This class with template method is responsible for output question data
 * to speified form.
 */

namespace PQMTool\Classes;

use PQMTool\Classes\Question;

abstract class QuestionPrinter
{
    protected $question;
    protected $numberOfQuestion;

    public function __construct($question, int $numberOfQuestion = 1)
    {
        $this->question = $question;
        $this->numberOfQuestion = $numberOfQuestion;
    }

    public function output(): String
    {
        $output = '';
        $output .= $this->printText();
        $output .= $this->printAnswer();
        return $output;
    }

    abstract function printText(): String;

    abstract function printAnswer(): String;
}