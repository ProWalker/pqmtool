<?php

namespace PQMTool\Classes\Parsers;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\QuestionData;

class MultichoiceQuestionAnswerParserTest extends TestCase
{

    public function questionAnswersProvider(): array
    {
        return [
            ['1', [0]],
            ['1, 2, 3', [0, 1, 2]],
            ['1, 3, 4', [0, 2, 3]],
            ['4, 1, 3', [0, 2, 3]],
            ['4,               1,3    ', [0, 2, 3]]
        ];
    }

    /**
     * @dataProvider questionAnswersProvider
     * @param String $rawAnswer
     * @param array $expectedAnswer
     * @throws \PQMTool\Classes\Exceptions\QuestionFormatException
     */
    public function testParseAnswer(String $rawAnswer, array $expectedAnswer)
    {
        $data = new QuestionData();
        $data->setQuestionType('multichoice');
        $data->setQuestionText('Какие теги используются для определения заголовков?');
        $data->addAnswerVariant('h1-h6');
        $data->addAnswerVariant('Header');
        $data->addAnswerVariant('Heading');
        $data->addAnswerVariant('hr');
        $data->setAnswer($rawAnswer);
        $answerParser = new MultichoiceQuestionAnswerParser();
        $answer = $answerParser->parseAnswer($data);
        $this->assertEquals($expectedAnswer, $answer);
    }
}
