<?php

namespace PQMTool\Classes\Questions;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Parsers\MultichoiceQuestionAnswerParser;
use PQMTool\Classes\Validators\MultichoiceDataValidator;

class QuestionTest extends TestCase
{

    public function testBuild(): Question
    {
        $data = new QuestionData();
        $data->setQuestionType('multichoice');
        $data->setQuestionText('Какие теги используются для определения заголовков?');
        $data->addAnswerVariant('h1-h6');
        $data->addAnswerVariant('Header');
        $data->addAnswerVariant('Heading');
        $data->addAnswerVariant('hr');
        $data->setAnswer('1');
        $dataValidator = new MultichoiceDataValidator();
        $answerParser = new MultichoiceQuestionAnswerParser();
        $question = new Question($data, $dataValidator, $answerParser);

        return $question;
    }

    /**
     * @depends testBuild
     * @param Question $question
     */
    public function testGetAnswers(Question $question)
    {
        $this->assertEquals([0], $question->getAnswers());
    }

    /**
     * @depends testBuild
     * @param Question $question
     */
    public function testGetType(Question $question)
    {
        $this->assertEquals('multichoice', $question->getType());
    }

    /**
     * @depends testBuild
     * @param Question $question
     */
    public function testGetAnswerVariants(Question $question)
    {
        $answerVariants = [
            'h1-h6',
            'Header',
            'Heading',
            'hr'
        ];
        $this->assertEquals($answerVariants, $question->getAnswerVariants());
    }

    /**
     * @depends testBuild
     * @param Question $question
     */
    public function testGetText(Question $question)
    {
        $this->assertEquals('Какие теги используются для определения заголовков?', $question->getText());
    }
}
