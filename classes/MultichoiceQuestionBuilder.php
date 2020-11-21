<?php

namespace Nik\Classes;

require __DIR__ . '/QuestionBuilder.php';

class MultichoiceQuestionBuilder extends QuestionBuilder
{
    function makeQuestion(): Question
    {
        parent::validation();
        $data = getQuestionData();
        if (count($data) == 1) {
            // To do: make question exception
            throw new \Exception("Error: Missing variants for the question.");
        }
        $answer = getQuestionAnswer();
        $question = new MultichoiceQuestion();
        $question->setText($data[0]);
        for ($i = 1, $len = count($data); $i < $len; $i++) {
            $question->setAnswers($data[$i]);
        }
        $question->setAnswer($answer);
        return $question;
    }
}