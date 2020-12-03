<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;

class ShortanswerQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validation();
        $data = $this->getQuestionData();
        if (count($data) > 1) {
            throw new QuestionFormatException("Error: Too many data for the short question.");
        }
        $answer = $this->getQuestionAnswer();
        $answer = preg_replace('/, +/m', ',', $answer);
        $question = new ShortanswerQuestion();
        $question->setText($data[0]);
        if (!$this->isAnswerValid($answer)) {
            throw new QuestionFormatException("Error: Answer is not valid.");
        }
        $answer = explode(",", $answer);
        $question->setAnswers($answer);
        return $question;
    }

    function isAnswerValid(String $answer): bool
    {
        $re = '/,,+|^,|,$/m';
        return !preg_match_all($re, $answer);
    }
}