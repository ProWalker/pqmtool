<?php

namespace PQMTool\Classes\Renderers;

/**
 * Class MultichoiceQuestionXmlRenderer
 * @package PQMTool\Classes\Renderers
 */
class MultichoiceQuestionXmlRenderer extends QuestionXmlRenderer implements IRenderer
{
    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(): string
    {
        $data = [
            'questionNum' => $this->numberOfQuestion,
            'questionText' => $this->question->getText(),
            'fraction' => 100 / count($this->question->getAnswers()),
            'answerVariants' => $this->question->getAnswerVariants(),
            'answers' => $this->question->getAnswers()
        ];
        $template = $this->twig->load('Multichoice.xml');
        return $template->render($data);
    }
}