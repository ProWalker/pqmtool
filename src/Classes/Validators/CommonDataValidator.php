<?php

namespace PQMTool\Classes\Validators;

use PQMTool\Classes\Exceptions\QuestionDataException;
use PQMTool\Classes\Questions\QuestionData;

/**
 * This validation is common for all questions
 *
 * All questions must have type, text and answer
 *
 * Class CommonDataValidator
 * @package PQMTool\Classes\Validators
 */
class CommonDataValidator implements IDataValidator
{
    /**
     * @param QuestionData $data
     * @return bool
     * @throws QuestionDataException
     */
    public function validateData(QuestionData $data): bool
    {
        if (empty($data->getQuestionType()))
        {
            throw new QuestionDataException("Error: Missing question type.");
        }
        if (empty($data->getQuestionText()))
        {
            throw new QuestionDataException("Error: Missing question text.");
        }
        if (empty($data->getAnswer()))
        {
            throw new QuestionDataException("Error: Missing question answer.");
        }

        return true;
    }
}