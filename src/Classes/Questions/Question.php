<?php

namespace PQMTool\Classes\Questions;

use PQMTool\Classes\Parsers\IQuestionAnswerParser;
use PQMTool\Classes\Validators\IDataValidator;

/**
 * Main question class.
 */
class Question {
    /**
     * Type of question.
     *
     * @var string
     */
    protected String $type = "";

    /**
     * This is text of question.
     *
     * @var string
     */
    protected String $text = "";

    /**
     * Answer variants for the question.
     * Not all questions may have variants.
     *
     * @var array
     */
    protected array $answerVariants = [];

    /**
     * Right answer/answers for the question.
     *
     * @var array
     */
    protected array $answers = [];

    /**
     * Data from witch we will build question.
     *
     * @var QuestionData
     */
    protected QuestionData $data;

    /**
     * IDataValidator objects checks question data before building question.
     *
     * @var IDataValidator
     */
    protected IDataValidator $dataValidator;

    /**
     * This interface provide method for parse answer into right format for specified type of question.
     *
     * @var IQuestionAnswerParser
     */
    protected IQuestionAnswerParser $answerParser;

    /**
     * Question constructor.
     * @param QuestionData $data
     * @param IDataValidator $dataValidator
     * @param IQuestionAnswerParser $answerParser
     * @throws \PQMTool\Classes\Exceptions\QuestionDataException
     */
    public function __construct(QuestionData $data, IDataValidator $dataValidator, IQuestionAnswerParser $answerParser)
    {
        $this->data = $data;
        $this->dataValidator = $dataValidator;
        $this->answerParser = $answerParser;
        $this->build();
    }

    /**
     * Main function for building question
     *
     * @throws \PQMTool\Classes\Exceptions\QuestionDataException
     */
    function build(): void
    {
        $this->dataValidator->validateData($this->data);
        $this->type = $this->data->getQuestionType();
        $this->text = $this->data->getQuestionText();
        $this->answerVariants = $this->data->getAnswerVariants();
        $this->answers = $this->answerParser->parseAnswer($this->data);
    }

    function getType(): String
    {
        return $this->type;
    }

    function getText(): String
    {
        return $this->text;
    }

    function getAnswerVariants(): array
    {
        return $this->answerVariants;
    }

    function getAnswers(): array
    {
        return $this->answers;
    }

}