<?php

namespace Nik\Classes;

/**
 * Subjects needs to return xml representation for moodle question
 */

// To do: Needs to replace interface for Factory
interface QuestionToXml
{
    function toXml();
}