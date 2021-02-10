<?php

namespace PQMTool\Classes\Renderers;

/**
 * Class ShortanswerQuestionXmlRenderer
 * @package PQMTool\Classes\Renderers
 */
class ShortanswerQuestionXmlRenderer extends QuestionXmlRenderer implements IRenderer
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
            'questionType' => $this->question->getType(),
            'questionNum' => $this->numberOfQuestion,
            'questionText' => $this->question->getText(),
            'answers' => $this->question->getAnswers()
        ];
        $template = $this->twig->load('Shortanswer.xml');
        return $template->render($data);
    }
}