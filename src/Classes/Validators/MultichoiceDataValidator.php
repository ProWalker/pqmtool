<?php

namespace PQMTool\Classes\Validators;

use PQMTool\Classes\Exceptions\QuestionDataException;
use PQMTool\Classes\Questions\QuestionData;

class MultichoiceDataValidator extends CommonDataValidator
{
    /**
     * @param QuestionData $data
     * @throws QuestionDataException
     */
    public function validateData(QuestionData $data): bool
    {
        parent::validateData($data);

        if (empty($data->getAnswerVariants()))
        {
            throw new QuestionDataException("Error: Missing answer variants.");
        }

        $answer = str_replace(' ', '', $data->getAnswer());

        if (!$this->isAnswerValid($answer))
        {
            throw new QuestionDataException("Error: Answer is not valid.");
        }

        return true;
    }

    /**
     * @param String $answer
     * @return bool
     */
    function isAnswerValid(String $answer): bool
    {
        $re = '/[^ ,\d]|,,+|^,|,$|^$|^ +$/m';
        return !preg_match_all($re, $answer);
    }
}