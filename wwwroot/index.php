<?php

require_once __DIR__ . '/../core/bootstrap.php';

/**
 * App\Post
 *
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $text
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\Comment[] $comments
 */
//class FFF extends \Illuminate\Database\Eloquent\Model {
//
//}
//
//$widget = new FFF();
//$widget->serial_number = 123;
//$widget->name = 'My Test Widget';
//$widget->save();
//
//die('ff');