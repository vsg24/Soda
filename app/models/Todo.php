<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Todo extends Model
{
    protected $fillable = ['title','category','description'];
}