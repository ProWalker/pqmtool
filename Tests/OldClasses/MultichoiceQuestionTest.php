<?php

namespace PQMTool\Tests\Classes;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\MultichoiceQuestion;

class MultichoiceQuestionTest extends TestCase
{
    public function testText()
    {
        $multichoiceQuestion = new MultichoiceQuestion();
        $multichoiceQuestion->setText("Question 1");
        $this->assertEquals("Question 1", $multichoiceQuestion->getText());
        return $multichoiceQuestion;
    }

    /**
     * @depends testText
     */
    public function testAnswerVariants($question)
    {
        $question->setAnswerVariant("Variant 1");
        $question->setAnswerVariant("Variant 2");
        $question->setAnswerVariant("Variant 3");
        $answerVariants = [
            "Variant 1",
            "Variant 2",
            "Variant 3",
        ];
        $this->assertEquals($answerVariants, $question->getAnswerVariants());
        return $question;
    }

    /**
     * @depends testAnswerVariants
     * @dataProvider answerProvider
     */
    public function testAnswer($answers, $question)
    {
        $question->setAnswers($answers);
        $this->assertEquals($answers, $question->getAnswers());
    }

    public function answerProvider()
    {
        return [
            [[0]],
            [[0, 1, 2]],
        ];
    }
}