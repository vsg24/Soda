<?php

namespace App\Utils;

/**
 * Contains some wrappers around built-in PHP password hashing functions
 *
 * Class PasswordV1
 * @package NOMVC\Utils
 */
class PasswordV1
{
    public static $ALGORITHM = PASSWORD_DEFAULT;

    /**
     * Generates a hashed string for the passed password using PHP's internal password_hash()
     *
     * @param string $password
     * @return bool|string
     */
    public static function passwordHash($password)
    {
        $hash = password_hash($password, PasswordV1::$ALGORITHM);
        return $hash;
    }

    /**
     * Checks whether the provided password matches the provided hash string
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function passwordVerify($password, $hash)
    {
        $stat = password_verify($password, $hash);
        return $stat ? true : false;
    }

    /**
     * Checks whether the first passed hash string is equal to the second passed hash string
     * Simply checks the two string for equality
     *
     * @param string $hashed_input
     * @param string $hashed_password
     * @return bool
     */
    public static function hashedPasswordVerify($hashed_input, $hashed_password)
    {
        if($hashed_input === $hashed_password)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Checks whether the password needs to be rehashed based on a new algorithm or not
     *
     * @param string $hashed_password
     * @param int $algorithm
     * @return bool
     */
    public static function passwordNeedsRehash($hashed_password, $algorithm)
    {
        if(password_needs_rehash($hashed_password, $algorithm))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Returns information about a given hash
     *
     * @param string $hashed_password
     * @return array
     */
    public static function passwordInfo($hashed_password)
    {
        return password_get_info($hashed_password);
    }
}