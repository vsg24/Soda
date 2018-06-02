<?php

namespace App\Utils;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class JWTHelper
{
    public static $ALGORITHM = 'HS256';

    public static function encode($data)
    {
        // standard jwt claims
        $data['iat'] = time();
        $data['iss'] = SITE_ADDRESS;
        $data['exp'] = self::getNewTokenExpirationDate();

        $jwt = JWT::encode($data, JWT_SECRET);
        return $jwt;
    }

    public static function decode($jwt)
    {
        $data = null;

        try
        {
            $data = (array) JWT::decode($jwt, JWT_SECRET, [JWTHelper::$ALGORITHM]);
        }
        catch (ExpiredException $e)
        {
            $data = -1;
        }
        catch (\Exception $e) {
            $data = null;
        }

        return $data;
    }

    public static function decodeExpiredOrNonExpiringToken($jwt)
    {
        $data = null;

        try
        {
            JWT::$timestamp = 0;
            $data = (array) JWT::decode($jwt, JWT_SECRET, [JWTHelper::$ALGORITHM]);
        }
        catch (\Exception $e) {
            $data = null;
        }

        return $data;
    }

    public static function getNewTokenExpirationDate()
    {
        return strtotime('+24 hours');
    }
}