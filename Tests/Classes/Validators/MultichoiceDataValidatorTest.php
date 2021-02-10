<?php

namespace PQMTool\Classes\Validators;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\QuestionData;

class MultichoiceDataValidatorTest extends TestCase
{

    public function answersProvider()
    {
        return [
            ['1'],
            [' 1, 2'],
            [' 3   ,  2, 6 ']
        ];
    }

    public function badAnswersProvider()
    {
        return [
            [''],
            [' '],
            [',1'],
            ['1,2,'],
            ['a1,3']
        ];
    }

    /**
     * @dataProvider answersProvider
     */
    public function testIsAnswerValid(String $answer)
    {
        $questionData = new QuestionData();
        $questionData->setQuestionType('multichoice');
        $questionData->setQuestionText('Question text.');
        $questionData->addAnswerVariant('Variant 1');
        $questionData->addAnswerVariant('Variant 2');
        $questionData->addAnswerVariant('Variant 3');
        $questionData->setAnswer($answer);
        $dataValidator = new MultichoiceDataValidator();
        $this->assertTrue($dataValidator->isAnswerValid($questionData->getAnswer()));
    }

    /**
     * @dataProvider badAnswersProvider
     * @param string $badAnswer
     */
    public function testFailingIsAnswerValid(string $badAnswer)
    {
        $questionData = new QuestionData();
        $questionData->setQuestionType('multichoice');
        $questionData->setQuestionText('Question text.');
        $questionData->addAnswerVariant('Variant 1');
        $questionData->addAnswerVariant('Variant 2');
        $questionData->addAnswerVariant('Variant 3');
        $questionData->setAnswer($badAnswer);
        $dataValidator = new MultichoiceDataValidator();
        $this->assertFalse($dataValidator->isAnswerValid($questionData->getAnswer()));
    }

    /**
     * @expectedException \PQMTool\Classes\Exceptions\QuestionDataException
     */
    public function testFailingValidateData()
    {
        $badQuestionData = new QuestionData();
        $badQuestionData->setQuestionType('multichoice');
        $badQuestionData->setQuestionText('Question text.');
        $badQuestionData->setAnswer('1');
        $dataValidator = new MultichoiceDataValidator();
        $dataValidator->validateData($badQuestionData);
    }
}
