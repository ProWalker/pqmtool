<?php

namespace PQMTool\Classes\Parsers;

use PHPUnit\Framework\TestCase;
use PQMTool\Classes\Questions\Question;
use PQMTool\Classes\Questions\QuestionData;
use PQMTool\Classes\Validators\MultichoiceDataValidator;
use PQMTool\Classes\Validators\ShortanswerDataValidator;

class QuestionDataFileParserTest extends TestCase
{
    protected string $filePath;
    protected array $questions;

    protected function setUp()
    {
        $this->filePath = __DIR__ . '/../../test.txt';
        $this->questions = [];

        $data = new QuestionData();
        $data->setQuestionType('multichoice');
        $data->setQuestionText('Какие теги используются для определения заголовков?');
        $data->addAnswerVariant('h1-h6');
        $data->addAnswerVariant('Header');
        $data->addAnswerVariant('Heading');
        $data->addAnswerVariant('hr');
        $data->setAnswer('1');
        $dataValidator = new MultichoiceDataValidator();
        $answerParser = new MultichoiceQuestionAnswerParser();
        $multichoiceQuestion = new Question($data, $dataValidator, $answerParser);
        $this->questions[] = $multichoiceQuestion;

        $data = new QuestionData();
        $data->setQuestionType('shortanswer');
        $data->setQuestionText('HTML-tag for drawing with JavaScript.');
        $data->setAnswer('Canvas');
        $dataValidator = new ShortanswerDataValidator();
        $answerParser = new ShortanswerQuestionAnswerParser();
        $shortanswerQuestion = new Question($data, $dataValidator, $answerParser);
        $this->questions[] = $shortanswerQuestion;
    }

    /**
     * @throws \PQMTool\Classes\Exceptions\QuestionDataException
     */
    public function testParse()
    {
        $actualQuestions = [];
        $fileParser = new QuestionDataFileParser();
        $questionsData = $fileParser->parse($this->filePath);
        foreach ($questionsData as $data) {
            $questionType = $data->getQuestionType();
            $dataValidator = null;
            $answerParser = null;
            if ($questionType == 'multichoice')
            {
                $dataValidator = new MultichoiceDataValidator();
                $answerParser = new MultichoiceQuestionAnswerParser();
            }
            elseif ($questionType == 'shortanswer')
            {
                $dataValidator = new ShortanswerDataValidator();
                $answerParser = new ShortanswerQuestionAnswerParser();
            }
            $question = new Question($data, $dataValidator, $answerParser);
            $actualQuestions[] = $question;
        }

        $this->assertEquals($this->questions[0], $actualQuestions[0]);
        $this->assertEquals($this->questions[1], $actualQuestions[1]);
    }
}
