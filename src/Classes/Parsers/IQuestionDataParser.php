<?php

/**
 * Basic interface for parsers
 */

namespace PQMTool\Classes\Parsers;

interface IQuestionDataParser
{
    public function parse(string $path): array;
}