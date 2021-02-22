<?php

namespace PQMTool\Classes\Renderers;

/**
 * All renderers must implement this interface.
 *
 * Renderers is classes responsible for representation questions in various forms, like html, xml, etc.
 *
 * Interface IRenderer
 * @package PQMTool\Classes\Renderers
 */
interface IRenderer
{
    /**
     * @return String
     */
    public function render(): String;
}