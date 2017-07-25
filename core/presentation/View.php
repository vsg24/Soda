<?php

namespace Soda\Core\Presentation;

class View
{
    private $view;

    function __construct()
    {
        $templates_path = PROJECT_ROOT_ABS_PATH . '/app/views/';
        $cache_path =  PROJECT_ROOT_ABS_PATH . '/app/cache/';

        $this->view = new Renderer($templates_path, $cache_path);
    }

    function getViewEngineInstance()
    {
        return $this->view;
    }
}