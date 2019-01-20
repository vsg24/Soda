<?php

namespace App\Controllers;

use MongoDB\BSON\ObjectID;
use MongoDB\Database;
use Soda\Core\Http\Controller;
use App\Models\Todo, App\Models\User;

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
        //https://siipo.la/blog/how-to-use-eloquent-orm-migrations-outside-laravel
        //exec:  vendor/bin/phinx create xxxx

        \Illuminate\Database\Capsule\Manager::schema()->create('users', function ( $table) {

            $table->increments('id');

            $table->string('name');

            $table->string('email')->unique();

            $table->string('password');

            $table->string('userimage')->nullable();

            $table->string('api_key')->nullable()->unique();

            $table->rememberToken();

            $table->timestamps();

        });

        $user = User::Create([
            'name' => "Kshiitj Soni",
            'email' => "kshitij206@gmail.com",
            'password' => password_hash("1234",PASSWORD_BCRYPT)
        ]);

        print_r($user->todo()->create([

            'todo' => "Working with Eloquent Without PHP",

            'category' => "eloquent",

            'description' => "Testing the work using eloquent without laravel"

        ]));

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