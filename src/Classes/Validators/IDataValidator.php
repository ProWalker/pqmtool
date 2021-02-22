<?php

namespace PQMTool\Classes\Validators;

use PQMTool\Classes\Exceptions\QuestionDataException;
use PQMTool\Classes\Questions\QuestionData;

/**
 * Main interface for validation question data.
 *
 * Interface IDataValidator
 * @package PQMTool\Classes\Validators
 */
interface IDataValidator
{
    /**
     * @param QuestionData $data
     * @return bool
     * @throws QuestionDataException
     */
    public function validateData(QuestionData $data): bool;
}