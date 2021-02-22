<?php

namespace PQMTool\Classes\Questions;

class QuestionData
{
    protected string $questionType;
    protected string $questionText;
    protected array $answerVariants;
    protected string $answer;

    public function __construct()
    {
        $this->questionType = '';
        $this->questionText = '';
        $this->answerVariants = [];
        $this->answer = '';
    }

    /**
     * @return string
     */
    public function getQuestionType(): string
    {
        return $this->questionType;
    }

    /**
     * @param string $questionType
     */
    public function setQuestionType(string $questionType): void
    {
        $this->questionType = $questionType;
    }

    /**
     * @return string
     */
    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    /**
     * @param string $questionText
     */
    public function setQuestionText(string $questionText): void
    {
        $this->questionText = $questionText;
    }

    /**
     * @return array
     */
    public function getAnswerVariants(): array
    {
        return $this->answerVariants;
    }

    /**
     * @param array $answerVariants
     */
    public function setAnswerVariants(array $answerVariants): void
    {
        $this->answerVariants = $answerVariants;
    }

    /**
     * @param string $answerVariant
     */
    public function addAnswerVariant(string $answerVariant): void
    {
        $this->answerVariants[] = $answerVariant;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }
}