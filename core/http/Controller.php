<?php

namespace Soda\Core\Http;

use Soda\Core\Database\DoctrineMongoDBODM;
use Soda\Core\Database\PHPDataObjects;
use Soda\Core\Presentation\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class Controller
{
    private $request;
    private $response;
    private $view;

    private $doctrine;
    private $pdo;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->view = new View();

        $this->doctrine = new DoctrineMongoDBODM();
        $this->pdo = new PHPDataObjects();
    }

    public function beforeActionExecution($action_name, $action_arguments) { }

    public function afterActionExecution($action_name, $action_arguments, $return_value) { }

    public function __call($name, $arguments)
    {
        $this->beforeActionExecution($name, $arguments);
        $return = call_user_func_array(array($this, $name), $arguments);
        $this->afterActionExecution($name, $arguments, $return);
        return $return;
    }

    public function result($data)
    {
        if(VIEW_ENGINE == 'php')
        {
            return $data;
        }
        $response = new Response($data);
        return $response->send();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function getView()
    {
        return $this->view->getViewEngineInstance();
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function getDoctrine()
    {
        return $this->doctrine;
    }

    public function render($template, $data = [], $merge = []) {
        return $this->result($this->getView()->render($template, $data, $merge));
    }
}