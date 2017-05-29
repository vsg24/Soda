<?php

namespace App\Models;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class User
{
    /** @ODM\Id */
    public $_id;

    /** @ODM\Field(type="string") */
    public $name;

    /** @ODM\Field(type="string") */
    public $email;

    /** @ODM\ReferenceMany(targetDocument="BlogPost", cascade="all") */
    public $posts = array();
}