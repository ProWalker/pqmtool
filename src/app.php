<?php

/**
 * Main application file
 */

namespace PQMTool;

require __DIR__ . '/autoload.php';
require __DIR__ . '/Lib/parse.php';

use function PQMTool\Lib\parseQuestions;
use function PQMTool\Lib\parseFileToArray;
use PQMTool\Classes\PQMTool;
use PQMTool\Classes\MultichoiceQuestion;
use PQMTool\Classes\MultichoiceQuestionXmlPrinter;

$loader = new Psr4AutoloaderClass();
$loader->register();

$textFile = $argv[1];

$tool = new PQMTool();

$fileToArray = parseFileToArray($textFile);
$questions = $tool->parseQuestions($fileToArray);

$toXml = $tool->questionsToXml($questions);
print_r($toXml);

// print_r($questions);

// $question = new MultichoiceQuestion();
// $question->setText("Question 1");
// $question->setAnswerVariant("Variant 1");
// $question->setAnswerVariant("Variant 2");
// $question->setAnswerVariant("Variant 3");
// $question->setAnswers([2]);

// $printer = new MultichoiceQuestionXmlPrinter($question);
// print_r($printer->output());