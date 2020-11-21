<?php

namespace Nik\Classes;

// require __DIR__ . '/Question.php';
// require __DIR__ . '/QuestionToXml.php';

/**
 * Multichoice quiestion
 * This type of question needs to answers and right answers
 */
class MultichoiceQuestion extends Question
{
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