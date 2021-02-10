<?php

namespace PQMTool\Tests\Classes;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\PQMTool;

class PQMToolTest extends TestCase
{
    public function testParseQuestions()
    {
        $text = "Question 1\n
                Variant 1\n
                Variant 2\n
                Variant 3\n
                Answer: 1, 2\n
                shortanswer\n
                Question 2\n
                Answer: Answer";
        $tool = new PQMTool();
        $coll = explode("\n", $text);
        $questions = $tool->parseQuestions($coll);
    }
}