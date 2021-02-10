<?php

namespace PQMTool\Classes\Validators;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\QuestionData;

class ShortanswerDataValidatorTest extends TestCase
{

    public function questionAnswerProvider()
    {
        return [
            ['Canvas'],
            ['Canvas tag'],
            ['Canvas, Canvas tag']
        ];
    }

    public function badQuestionAnswerProvider()
    {
        return [
            [''],
            ['   '],
            [',canvas'],
            ['canvas,'],
        ];
    }

    /**
     * @dataProvider questionAnswerProvider
     * @param string $answer
     */
    public function testIsAnswerValid(string $answer)
    {
        $data = new QuestionData();
        $data->setQuestionType('shortanswer');
        $data->setQuestionText('HTML-tag for drawing with JavaScript.');
        $data->setAnswer($answer);
        $dataValidator = new ShortanswerDataValidator();
        $this->assertTrue($dataValidator->isAnswerValid($data->getAnswer()));
    }

    /**
     * @dataProvider badQuestionAnswerProvider
     * @param string $badAnswer
     */
    public function testFailingIsAnswerValid(string $badAnswer)
    {
        $data = new QuestionData();
        $data->setQuestionType('shortanswer');
        $data->setQuestionText('HTML-tag for drawing with JavaScript.');
        $data->setAnswer($badAnswer);
        $dataValidator = new ShortanswerDataValidator();
        $this->assertFalse($dataValidator->isAnswerValid($data->getAnswer()));
    }

    public function testValidateData()
    {
        $data = new QuestionData();
        $data->setQuestionType('shortanswer');
        $data->setQuestionText('HTML-tag for drawing with JavaScript.');
        $data->setAnswer('Canvas');
        $dataValidator = new ShortanswerDataValidator();
        $this->assertTrue($dataValidator->validateData($data));
    }
}
