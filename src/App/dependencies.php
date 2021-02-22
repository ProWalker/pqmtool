<?php

use DI\ContainerBuilder;
use PQMTool\Classes\Parsers\MultichoiceQuestionAnswerParser;
use PQMTool\Classes\Parsers\ShortanswerQuestionAnswerParser;
use PQMTool\Classes\Questions\Question;
use PQMTool\Classes\Questions\QuestionData;
use PQMTool\Classes\Renderers\MultichoiceQuestionXmlRenderer;
use PQMTool\Classes\Renderers\QuizXmlRenderer;
use PQMTool\Classes\Renderers\ShortanswerQuestionXmlRenderer;
use PQMTool\Classes\Validators\MultichoiceDataValidator;
use PQMTool\Classes\Validators\ShortanswerDataValidator;

return function (ContainerBuilder $containerBuilder)
{
    $containerBuilder->addDefinitions([
        'multichoice' => DI\create(Question::class)
            ->constructor(QuestionData::class,
                new MultichoiceDataValidator(),
                new MultichoiceQuestionAnswerParser()),
        'shortanswer' => DI\create(Question::class)
            ->constructor(QuestionData::class,
                new ShortanswerDataValidator(),
                new ShortanswerQuestionAnswerParser()),
        'multichoice_renderer' => DI\create(MultichoiceQuestionXmlRenderer::class),
        'shortanswer_renderer' => DI\create(ShortanswerQuestionXmlRenderer::class),
        'quiz_renderer' => DI\create(QuizXmlRenderer::class),
    ]);
};