<?php

namespace Soda\Core\Presentation;

use Jenssegers\Blade\Blade;

class Renderer
{
    private $templates_path;
    private $cache_path;

    public function __construct($templates_path, $cache_path)
    {
        $this->templates_path = $templates_path;
        $this->cache_path = $cache_path;
    }

    public function render($template_file_name, $data = [], $merge = [])
    {
        if(VIEW_ENGINE == 'php')
        {
            return include_once $this->templates_path . $template_file_name . '.php';
        }
        elseif(VIEW_ENGINE == 'blade')
        {
            $blade = new Blade([$this->templates_path], $this->cache_path);
            return $blade->render($template_file_name, $data, $merge);
        }
    }
}