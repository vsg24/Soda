<?php

namespace Soda\Core\Http;

use Soda\Core\Database\MongoDBClient;
use Soda\Core\Database\PHPDataObjects;
use Soda\Core\Presentation\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class Controller
{
    private $request;
    private $response;
    private $view;

    private $mdb;
    private $pdo;

    private $router;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->view = new View();

        if(MONGO_DB_ENABLED)
            $this->mdb = new MongoDBClient();
        if(SQL_DB_ENABLED)
            $this->pdo = new PHPDataObjects();

        global $router;
        $this->router = $router;
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

    public function getMongoDB()
    {
        return $this->mdb;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function echoError($data): Response {
        header("HTTP/1.1 500 Internal Server Error");
        if(is_array($data))
        {
            header('Content-Type: application/json');
            die(json_encode($data));
        } else if($data == null) {
            die();
        } else {
            die($data);
        }
    }

    public function echoNormal($data): Response {
        if(is_array($data))
        {
            header('Content-Type: application/json');
            die(json_encode($data));
        } else if($data == null) {
            die();
        } else {
            die($data);
        }
    }

    public function echoHttp($data, $code): Response {
        http_response_code($code);
        if(is_array($data))
        {
            header('Content-Type: application/json');
            die(json_encode($data));
        } else if($data == null) {
            die();
        } else {
            die($data);
        }
    }

    public function render($template, $data = [], $merge = []) {
        return $this->result($this->getView()->render($template, $data, $merge));
    }
}