<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;

/**
 * Multichoice quiestion
 * This type of question needs to answers and right answers
 */
class MultichoiceQuestion extends Question
{
    protected String $type = "multichoice";

    // Variants of answer for the question
    protected array $answerVariants = [];

    function setAnswerVariant(String $variant)
    {
        $this->answerVariants[] = $variant;
    }

    function getAnswerVariants(): array
    {
        return $this->answerVariants;
    }
}