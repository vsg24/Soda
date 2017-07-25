<?php

namespace App\Models;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class BlogPost
{
    /** @ODM\Id */
    public $_id;

    /** @ODM\Field(type="string") */
    public $title;

    /** @ODM\Field(type="string") */
    public $body;

    /** @ODM\Field(type="date") */
    public $createdAt;
}