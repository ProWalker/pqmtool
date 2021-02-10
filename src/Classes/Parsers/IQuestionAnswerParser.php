<?php

/**
 * Main interface for parsing question answers
 */

namespace PQMTool\Classes\Parsers;

use PQMTool\Classes\Questions\QuestionData;

interface IQuestionAnswerParser
{
    public function parseAnswer(QuestionData $data): array;
}