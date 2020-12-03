<?php

namespace PQMTool\Tests\Classes;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\MultichoiceQuestion;
use PQMTool\Classes\MultichoiceQuestionBuilder;

class MultichoiceQuestionBuilderTest extends TestCase
{
    /**
     * @dataProvider answerProvider
     */
    public function testMakeQuestion($stringAnswer, $expectedAnswer)
    {
        $data = [
            "Question 1",
            "Variant 1",
            "Variant 2"
        ];
        $builder = new MultichoiceQuestionBuilder($data, $stringAnswer);
        $question = new MultichoiceQuestion();
        $question->setText("Question 1");
        $question->setAnswerVariant("Variant 1");
        $question->setAnswerVariant("Variant 2");
        $question->setAnswers($expectedAnswer);

        $this->assertEquals($question, $builder->makeQuestion());
    }

    public function answerProvider()
    {
        return [
            ["1", [0]],
            ["1, 2", [0, 1]],
            ["1, 2, 3", [0, 1, 2]],
            ["3, 1, 2", [0, 1, 2]]
        ];
    }

    /**
     * @dataProvider incorrectDataProvider
     * @expectedException PQMTool\Classes\Exceptions\QuestionFormatException
     */
    public function testInvalidQuestionFormat($data, $answer)
    {
        $builder = new MultichoiceQuestionBuilder($data, $answer);
        $builder->makeQuestion();
    }

    public function incorrectDataProvider()
    {
        return [
            [[""], ""],
            [["Question 1"], ""],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], ""],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], ",1"],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], "1,"],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], "4"],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], ","],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], "1.5"],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], "1b"],
            [["Question 1", "Variant 1", "Variant 2", "Variant 3"], "-1"]
        ];
    }
}