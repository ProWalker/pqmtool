<?php

namespace Nik\Classes;

class ShortQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validate();
        $data = getQuestionData();
        if (count($data) > 1) {
            // To do: make question exception
            throw new \Exception("Error: Too many data for the short question.");
        }
        $answer = getQuestionAnswer();
        $question = new ShortQuestion();
        $question->setText($data[0]);
        $question->setAnswer($answer);
        return $question;
    }
}