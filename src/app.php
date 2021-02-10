<?php

/**
 * Main application file
 */

namespace PQMTool;

//require __DIR__ . '/autoload.php';
//require __DIR__ . '/Lib/parse.php';
require __DIR__ . '/../vendor/autoload.php';

use PQMTool\Classes\PQMTool;
use PQMTool\Classes\MultichoiceQuestion;
use PQMTool\Classes\MultichoiceQuestionXmlPrinter;
use PQMTool\Classes\ShortanswerQuestion;
use PQMTool\Classes\ShortanswerQuestionXmlPrinter;
use function PQMTool\Lib\parseFileToArray;

define("TEMPLATES_PATH", __DIR__ . '/Templates');

// $loader = new Psr4AutoloaderClass();
// $loader->register();

 $inputFile = $argv[1];
 $outputFile = $argv[2];

 $tool = new PQMTool();

 $fileToArray = parseFileToArray($inputFile);
 $questions = $tool->parseQuestions($fileToArray);

 $toXml = $tool->questionsToXml($questions);
 file_put_contents($outputFile, $toXml);

// print_r($questions);

// $question = new MultichoiceQuestion();
// $question->setText("Question 1");
// $question->setAnswerVariant("Variant 1");
// $question->setAnswerVariant("Variant 2");
// $question->setAnswerVariant("Variant 3");
// $question->setAnswers([2]);

// $printer = new MultichoiceQuestionXmlPrinter($question);
// print_r($printer->output());

//$question = new ShortanswerQuestion();
//$question->setText("Question 1");
//$question->setAnswers(["Answer"]);
//
//$printer = new ShortanswerQuestionXmlPrinter($question);
//print_r($printer->output());