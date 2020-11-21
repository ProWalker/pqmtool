<?php

/**
 * Main application file
 */

namespace Nik;

require __DIR__ . '/lib/parse.php';

use function Nik\Lib\parseQuestions;
use function Nik\Lib\parseFileToArray;

$textFile = $argv[1];

$fileToArray = parseFileToArray($textFile);
$questions = parseQuestions($fileToArray);

print_r($questions);