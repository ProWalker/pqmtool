<?php

namespace PQMTool\Classes\Questions;

use PHPUnit\Framework\TestCase;

class QuestionDataTest extends TestCase
{

    public function testQuestionData()
    {
        $data = new QuestionData();
        $data->setQuestionType('default');
        $data->setQuestionText('Какие теги используются для определения заголовков?');
        $data->addAnswerVariant('h1-h6');
        $data->addAnswerVariant('Header');
        $data->addAnswerVariant('Heading');
        $data->setAnswer('1');

        return $data;
    }

    public function test__construct()
    {

    }

    /**
     * @depends testQuestionData
     * @param QuestionData $questionData
     */
    public function testGetQuestionType(QuestionData $questionData)
    {
        $this->assertEquals('default', $questionData->getQuestionType());
    }

    /**
     * @depends testQuestionData
     * @param QuestionData $questionData
     */
    public function testGetQuestionText(QuestionData $questionData)
    {
        $this->assertEquals('Какие теги используются для определения заголовков?', $questionData->getQuestionText());
    }

    public function testSetQuestionType()
    {
        $data = new QuestionData();
        $data->setQuestionType('default');
        $this->assertEquals('default', $data->getQuestionType());
    }

    public function testSetAnswerVariants()
    {
        $answerVariants = [
            'h1-h6',
            'Header',
            'Heading'
        ];
        $data = new QuestionData();
        $data->setAnswerVariants($answerVariants);
        $this->assertEquals(['h1-h6', 'Header', 'Heading'], $data->getAnswerVariants());
    }

    public function testAddAnswerVariant()
    {
        $data = new QuestionData();
        $data->addAnswerVariant('h1-h6');
        $data->addAnswerVariant('Header');
        $data->addAnswerVariant('Heading');
        $this->assertEquals(['h1-h6', 'Header', 'Heading'], $data->getAnswerVariants());
    }

    /**
     * @depends testQuestionData
     * @param QuestionData $questionData
     */
    public function testGetAnswer(QuestionData $questionData)
    {
        $this->assertEquals('1', $questionData->getAnswer());
    }

    /**
     * @depends testQuestionData
     * @param QuestionData $questionData
     */
    public function testGetAnswerVariants(QuestionData $questionData)
    {
        $this->assertEquals(['h1-h6', 'Header', 'Heading'], $questionData->getAnswerVariants());
    }

    public function testSetQuestionText()
    {
        $data = new QuestionData();
        $data->setQuestionText('Какие теги используются для определения заголовков?');
        $this->assertEquals('Какие теги используются для определения заголовков?', $data->getQuestionText());
    }

    public function testSetAnswer()
    {
        $data = new QuestionData();
        $data->setAnswer('1');
        $this->assertEquals('1', $data->getAnswer());
    }
}
