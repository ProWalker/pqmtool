<?php

namespace PQMTool\Tests\Classes;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\ShortanswerQuestion;

class ShortanswerQuestionTest extends TestCase
{
    public function testText()
    {
        $shortanswerQuestion = new ShortanswerQuestion();
        $shortanswerQuestion->setText("Question 1");

        $this->assertEquals("Question 1", $shortanswerQuestion->getText());

        return $shortanswerQuestion;
    }

    /**
     * @depends testText
     */
    public function testAnswer($question)
    {
        $question->setAnswers(["Answer 1"]);

        $this->assertEquals(["Answer 1"], $question->getAnswers());
    }
}