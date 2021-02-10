<?php


namespace PQMTool\Classes\Parsers;


use PQMTool\Classes\Exceptions\QuestionFormatException;
use PQMTool\Classes\Questions\QuestionData;

class MultichoiceQuestionAnswerParser implements IQuestionAnswerParser
{

    /**
     * @param QuestionData $data
     * @return array
     * @throws QuestionFormatException
     */
    public function parseAnswer(QuestionData $data): array
    {
        $answer = str_replace(' ', '', $data->getAnswer());
        $answer = array_unique(explode(",", $answer));
        $answer = array_map(fn($index) => $index - 1, $answer);
        $variantsKeys = array_keys($data->getAnswerVariants());
        $diff = array_diff($answer, $variantsKeys);
        if (count($diff) > 0) {
            throw new QuestionFormatException("Error: Answer contains number that is not in range numbers of variants.");
        }
        sort($answer);

        return $answer;
    }
}