<?php

/**
 * Main application file
 */

namespace PQMTool;

// require __DIR__ . '/Lib/parse.php';
require __DIR__ . '/autoload.php';

use function PQMTool\Lib\parseQuestions;
use function PQMTool\Lib\parseFileToArray;
use PQMTool\Classes\PQMTool;

$loader = new Psr4AutoloaderClass();
$loader->register();

$textFile = $argv[1];

$tool = new PQMTool();

$fileToArray = parseFileToArray($textFile);
$questions = $tool->parseQuestions($fileToArray);

print_r($questions);