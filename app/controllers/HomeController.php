<?php

namespace App\Controllers;

use MongoDB\BSON\ObjectID;
use MongoDB\Database;
use Soda\Core\Http\Controller;
use App\Models\BlogPost, App\Models\User;

class HomeController extends Controller
{
	private $dm;
	
    public function beforeActionExecution($action_name, $action_arguments)
    {
        parent::beforeActionExecution($action_name, $action_arguments);
		
		// This method is called before any other action method
		// use it to do things like initialize class properties or
		// authenticate user based on SESSION/COOKIE or HEADER token
		
		$this->dm = $this->getMongoDB()->getDM();
    }

	// functions must be marked protected to be able to use beforeActionExecution
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

            $user = new User();
            $user->_id = new ObjectID();
            $user->name = 'John Doe';
            $user->email = 'john.doe@example.com';

            // tell Doctrine 2 to save $user on the next flush()
            $result = $this->dm->selectCollection(\DB_CONS::USERS)->insertOne((array) $user);

            // You may also use arrays
            $this->dm->selectCollection(\DB_CONS::POSTS)->insertOne([
                'title' => $title,
                'body' => $body,
                'authorId' => $result->getInsertedId(),
                'createdAt' => new \DateTime()
            ]);

            return $this->render('second', ['animal' => 'Cat', 'success' => true]);
        }
        return $this->render('second', ['animal' => 'Cat']);
    }
}