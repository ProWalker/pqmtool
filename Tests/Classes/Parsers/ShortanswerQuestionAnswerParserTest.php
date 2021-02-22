<?php

namespace PQMTool\Classes\Parsers;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\QuestionData;

class ShortanswerQuestionAnswerParserTest extends TestCase
{

    public function questionAnswerProvider()
    {
        return [
            ['canvas', ['canvas']],
            ['Canvas', ['canvas']],
            ['cAnVaS', ['canvas']],
            ['  CANVAS   ', ['canvas']],
            ['canvas, canvas', ['canvas', 'canvas']],
            ['  cAnVas,canvAs ', ['canvas', 'canvas']]
        ];
    }

    /**
     * @dataProvider questionAnswerProvider
     * @param string $rawAnswer
     * @param array $expectedAnswer
     */
    public function testParseAnswer(string $rawAnswer, array $expectedAnswer)
    {
        $data = new QuestionData();
        $data->setQuestionType('shortanswer');
        $data->setQuestionText('HTML-tag for drawing with JavaScript.');
        $data->setAnswer($rawAnswer);
        $answerParser = new ShortanswerQuestionAnswerParser();
        $answer = $answerParser->parseAnswer($data);
        $this->assertEquals($expectedAnswer, $answer);
    }
}
