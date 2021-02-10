<?php

/**
 * This class with template method is responsible for output question data
 * to xml form.
 */

namespace PQMTool\Classes;

class ShortanswerQuestionXmlPrinter extends QuestionPrinter
{
    private $loader;
    private $twig;

    public function __construct($question, int $numberOfQuestion = 1)
    {
        parent::__construct($question, $numberOfQuestion);
        $this->loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_PATH);
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => TEMPLATES_PATH . '/Cache/',
            'charset' => 'Windows-1251'
        ]);
    }

    public function output(): String
    {
        $data = [
            'questionNum' => $this->numberOfQuestion,
            'questionText' => $this->question->getText(),
            'answers' => $this->question->getAnswers()
        ];
        $template = $this->twig->load('Shortanswer.xml');
        $output = $template->render($data);
        return $output;
    }

    function printText(): String
    {
        return "";
    }

    function printAnswer(): String
    {
        return "";
    }
}