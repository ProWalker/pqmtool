<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions;

class MultichoiceQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validation();
        $data = $this->getQuestionData();
        if (count($data) == 1) {
            throw new QuestionFormatException("Error: Missing variants for the question.");
        }
        $answer = $this->getQuestionAnswer();
        $question = new MultichoiceQuestion();
        $question->setText($data[0]);
        for ($i = 1, $len = count($data); $i < $len; $i++) {
            $question->setAnswerVariant($data[$i]);
        }
        if (!$this->isAnswerValid($answer)) {
            throw new QuestionFormatException("Error: Answer is not valid.");
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