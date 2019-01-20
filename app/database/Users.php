<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint as Blueprint;

Capsule::schema()->create('users', function (Blueprint $table) {

    $table->increments('id');

    $table->string('name');

    $table->string('email')->unique();

    $table->string('password');

    $table->string('userimage')->nullable();

    $table->string('api_key')->nullable()->unique();

    $table->rememberToken();

    $table->timestamps();

});