<?php

namespace PQMTool\Lib;

use PQMTool\Classes\Question;
use PQMTool\Classes\MultichoiceQuestion;
use PQMTool\Classes\Exceptions\FileNotExistException;

/**
 * Usefull functions for parsing questions
 */

function parseFileToArray($file): array
{
    if (!file_exists($file)) {
        throw new FileNotExistException();
    }
    $file = file_get_contents($file);
    $file = mb_convert_encoding($file, 'UTF-8', 'Windows-1251');
    return explode("\n", $file);
}

function isAnswer(String $line): bool
{
    return strpos($line, 'Answer:') !== false;
}

function parseAnswer(String $line): String
{
    $answer = explode(':', $line)[1];
    return trim($answer);
}

function getQuestionTypes(): array
{
    $types = array('multichoice', 'shortanswer');
    return $types;
}

function stringIsEmpty(String $str): bool
{
    $str = trim($str);
    return isset($str) === true && $str === '';
}