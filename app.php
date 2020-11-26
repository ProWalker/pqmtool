<?php

/**
 * Main application file
 */

namespace Nik;

require __DIR__ . '/Lib/parse.php';
require __DIR__ . '/autoload.php';

use function Nik\Lib\parseQuestions;
use function Nik\Lib\parseFileToArray;

$loader = new Psr4AutoloaderClass();
$loader->register();

$textFile = $argv[1];

$fileToArray = parseFileToArray($textFile);
$questions = parseQuestions($fileToArray);

print_r($questions);