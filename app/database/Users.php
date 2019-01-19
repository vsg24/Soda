<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint as Blueprint;

// https://medium.com/@kshitij206/use-eloquent-without-laravel-7e1c73d79977

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