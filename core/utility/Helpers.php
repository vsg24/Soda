<?php

namespace App\Core\Utility;

class Helpers
{
    public static function Redirect(string $url): void
    {
        header("Location: $url");
        die();
    }
}