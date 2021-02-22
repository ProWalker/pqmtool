<?php

namespace PQMTool\Classes\Renderers;

use PQMTool\Classes\Questions\Question;

/**
 * Basic class for question xml representation.
 *
 * Class QuestionXmlRenderer
 * @package PQMTool\Classes\Renderers
 */
class QuestionXmlRenderer implements IRenderer
{
    protected $loader;
    protected $twig;
    protected Question $question;
    protected int $numberOfQuestion;

    public function __construct(Question $question, int $numberOfQuestion = 1, String $templatesPath = '')
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($templatesPath);
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => $templatesPath . '/Cache/',
        ]);
        $this->question = $question;
        $this->numberOfQuestion = $numberOfQuestion;
    }

    /**
     * All subclasses must override this method.
     *
     * @return string
     */
    public function render(): string
    {
        return "Question xml renderer warning: Subclass must override method render!";
    }
}