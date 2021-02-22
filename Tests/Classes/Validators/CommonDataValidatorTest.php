<?php

namespace PQMTool\Classes\Validators;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\QuestionData;

class CommonDataValidatorTest extends TestCase
{
    /**
     * @expectedException \PQMTool\Classes\Exceptions\QuestionDataException
     * @throws \PQMTool\Classes\Exceptions\QuestionDataException
     */
    public function testValidateData()
    {
        $badQuestionData = new QuestionData();
        $badQuestionData->setQuestionText('Question text.');
        $dataValidator = new CommonDataValidator();
        // No type question. Exception must be thrown.
        $dataValidator->validateData($badQuestionData);

        $badQuestionData->setQuestionType('default');
        // Reset text
        $badQuestionData->setQuestionText('');
        // Text question is empty. Exception must be thrown.
        $dataValidator->validateData($badQuestionData);

        $badQuestionData->setQuestionText('Question text.');
        // Question have no answer. Exception must be thrown.
        $dataValidator->validateData($badQuestionData);
    }
}
