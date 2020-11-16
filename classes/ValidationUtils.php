<?php


class ValidationUtils
{
    static function isEmpty($input)
    {
        if (empty($input)) {
            return true;
        }
        return false;
    }

    static function invalidEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

}