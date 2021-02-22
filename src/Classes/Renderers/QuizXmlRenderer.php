<?php

namespace PQMTool\Classes\Renderers;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class QuizXmlRenderer implements IRenderer
{
    protected string $questions;
    protected FilesystemLoader $loader;
    protected Environment $twig;

    public function __construct(string $questions, string $templatesPath)
    {
        $this->loader = new FilesystemLoader($templatesPath);
        $this->twig = new Environment($this->loader, [
            'cache' => $templatesPath . '/Cache/',
            'autoescape' => false
        ]);
        $this->questions = $questions;
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(): string
    {
        $data = [
            'questions' => $this->questions,
        ];
        $template = $this->twig->load('Quiz.xml');
        return $template->render($data);
    }
}