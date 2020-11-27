<?php

namespace PQMTool\Classes;

use PQMTool\Classes\Exceptions;

class ShortQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validate();
        $data = getQuestionData();
        if (count($data) > 1) {
            throw new QuestionFormatException("Error: Too many data for the short question.");
        }
        $answer = getQuestionAnswer();
        $question = new ShortQuestion();
        $question->setText($data[0]);
        if (!isValidAnswer($answer)) {
            throw new QuestionFormatException("Error: Answer is not valid.");
        }
        $question->setAnswer($answer);
        return $question;
    }

    function isValidAnswer(String $answer): bool
    {
        $re = '/[^a-zA-Zа-яА-Я\d,]|,,+|^,|,$/m';
        return !preg_match_all($re, $answer);
    }
}