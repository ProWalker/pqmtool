<?php


namespace PQMTool\Classes\Parsers;


use PQMTool\Classes\Questions\QuestionData;

class ShortanswerQuestionAnswerParser implements IQuestionAnswerParser
{

    public function parseAnswer(QuestionData $data): array
    {
        $answer = preg_replace('/, +/m', ',', $data->getAnswer());
        $answer = trim($answer);
        $answer = strtolower($answer);
        $answer = explode(",", $answer);

        return $answer;
    }
}