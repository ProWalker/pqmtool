<?php

namespace PQMTool;

use PQMTool\Classes\Parsers\QuestionDataFileParser;

require __DIR__ . '/../vendor/autoload.php';

define("TEMPLATES_PATH", __DIR__ . '/Templates');

$inputFile = $argv[1];
//$outputFile = $argv[2];

$parser = new QuestionDataFileParser();
$questionData = $parser->parse($inputFile);

print_r($questionData);