<?php

namespace PQMTool\Tests\Classes;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\ShortanswerQuestion;
use PQMTool\Classes\ShortanswerQuestionBuilder;

class ShortanswerQuestionBuilderTest extends TestCase
{
    /**
     * @dataProvider answerProvider
     */
    public function testMakeQuestion(String $stringAnswer, array $expectedAnswer)
    {
        $data = ["Question 1"];
        $builder = new ShortanswerQuestionBuilder($data, $stringAnswer);
        $question = new ShortanswerQuestion();
        $question->setText($data[0]);
        $question->setAnswers($expectedAnswer);

        $this->assertEquals($question, $builder->makeQuestion());
    }

    public function answerProvider()
    {
        return [
            ["Answer 1, Answer 2", ["Answer 1", "Answer 2"]],
            ["Answer-12345", ["Answer-12345"]],
            ["   Answer", ["Answer"]],
            ["Answer   ", ["Answer"]]
        ];
    }

    /**
     * @dataProvider incorrectDataProvider
     * @expectedException PQMTool\Classes\Exceptions\QuestionFormatException
     */
    public function testInvalidQuestionFormat($data, $answer)
    {
        $builder = new ShortanswerQuestionBuilder($data, $answer);
        $builder->makeQuestion();
    }

    public function incorrectDataProvider()
    {
        return [
            [[""], ""],
            [[" "], ""],
            [["Question"], ""],
            [["Question", "Another text"], "Answer"],
            [["Question"], ",Answer"],
            [["Question"], "Answer,"],
            [["Question"], "Answer 1,, Answer 2"],
            [["Question"], ","]
        ];
    }
}