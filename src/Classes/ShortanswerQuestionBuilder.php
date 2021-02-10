<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions\QuestionFormatException;

class ShortanswerQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        $data = $this->getQuestionData();
        $answer = $this->getQuestionAnswer();
        $answer = preg_replace('/, +/m', ',', $answer);
        $this->validation($data, $answer);
        $question = new ShortanswerQuestion();
        $question->setText($data[0]);
        $answer = explode(",", $answer);
        $question->setAnswers($answer);
        return $question;
    }

    function isAnswerValid(String $answer): bool
    {
        $re = '/,,+|^,|,$/m';
        return !preg_match_all($re, $answer);
    }

    function validation(array $data, string $answer)
    {
        parent::validation();
        if (count($data) > 1) {
            throw new QuestionFormatException("Error: Too many data for the short question.");
        }
        if (!$this->isAnswerValid($answer)) {
            throw new QuestionFormatException("Error: Answer is not valid.");
        }
    }
}