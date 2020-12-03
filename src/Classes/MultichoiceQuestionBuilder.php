<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;

class MultichoiceQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validation();
        $data = $this->getQuestionData();
        if (count($data) == 1) {
            throw new QuestionFormatException("Error: Missing variants for the question.");
        }
        $question = new MultichoiceQuestion();
        $question->setText($data[0]);
        for ($i = 1, $len = count($data); $i < $len; $i++) {
            $question->setAnswerVariant($data[$i]);
        }
        $answer = $this->getQuestionAnswer();
        $answer = str_replace(' ', '', $answer);
        if (!$this->isAnswerValid($answer)) {
            throw new QuestionFormatException("Error: Answer is not valid.");
        }
        $answer = array_unique(explode(",", $answer));
        sort($answer);
        $answer = array_map(fn($index) => $index - 1, $answer);
        $variantsKeys = array_keys($answer);
        $diff = array_diff($answer, $variantsKeys);
        if (count($diff) > 0) {
            throw new QuestionFormatException("Error: Answer contains number that is not in range numbers of variants.");
        }
        $question->setAnswers($answer);
        return $question;
    }

    function isAnswerValid(String $answer): bool
    {
        $re = '/[^,\d]|,,+|^,|,$/m';
        return !preg_match_all($re, $answer);
    }
}