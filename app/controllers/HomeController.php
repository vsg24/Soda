<?php

namespace App\Controllers;

use Soda\Core\Http\Controller;
use App\Models\BlogPost, App\Models\User;

class HomeController extends Controller
{
    public function beforeActionExecution($action_name, $action_arguments)
    {
        parent::beforeActionExecution($action_name, $action_arguments);
    }

    protected function index()
    {
        return $this->render('index');
    }

    protected function errorTest()
    {
        // This method throws an exception and shows the custom error page
        return $this->render('this does not exist');
    }

    protected function second()
    {
        if($this->getRequest()->isMethod('POST'))
        {
            $title = $this->getRequest()->request->get("title");
            $body = $this->getRequest()->request->get("body");

            $dm = $this->getDoctrine()->getDM();

            $user = new User();
            $user->name = 'John Doe';
            $user->email = 'john.doe@example.com';

            // tell Doctrine 2 to save $user on the next flush()
            $dm->persist($user);

            // create blog post
            $post = new BlogPost();
            $post->title = $title;
            $post->body = $body;
            $post->createdAt = new \DateTime();

            $user->posts = [$post];

            // store everything to MongoDB
            $dm->flush();

            return $this->render('second', ['animal' => 'Cat', 'success' => true]);
        }
        return $this->render('second', ['animal' => 'Cat']);
    }
}