<?php

namespace Soda\Core\Presentation;

class View
{
    private $view;

    function __construct()
    {
        $templates_path = __DIR__ . '../../../app/views/';
        $cache_path = __DIR__ . '/../../cache/';

        $this->view = new Renderer($templates_path, $cache_path);
    }

    function getViewEngineInstance()
    {
        return $this->view;
    }
}