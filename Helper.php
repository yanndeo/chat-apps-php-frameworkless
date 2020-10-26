<?php


namespace app;


class Helper extends core\Helper
{

    public static function getProfile(): string
    {
        $images = array("user_6", "user_2", "user_3", "user_5", "user_1");
        return $images[array_rand($images, 1) ];
    }
}