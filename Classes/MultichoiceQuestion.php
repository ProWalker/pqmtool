<?php

namespace Nik\Classes;

use Nik\Classes\Exceptions\QuestionFormatException;

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

    function setAnswers(String $answers)
    {
        $answers = str_replace(' ', '', $answers);
        $answers = array_map(fn($index) => $index - 1, explode(",", $answers));
        $this->answers = $answers;
        $variantsKeys = array_keys($this->getAnswerVariants());
        $diff = array_diff($answers, $variantsKeys);
        if (count($diff) > 0) {
            throw new QuestionFormatException("Error: Answer contains number that is not in range numbers of variants.");
        }
    }
}