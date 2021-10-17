<?php

class Token 
{
    public static function create($strength = 80)
    {
        $permittedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $input_length = strlen($permittedChars);

        $randomString = '';

        for($i = 0; $i < $strength; $i++) {

            $random_character = $permittedChars[mt_rand(0, $input_length - 1)];

            $randomString .= $random_character;
        }

        return $randomString;

    }
}