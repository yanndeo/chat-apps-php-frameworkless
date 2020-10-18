<?php
namespace app\core\form;

use app\core\Model;
use app\core\form\Field;

class Form
{


    public static function opening($action , $method = 'post'): Form
    {
         echo sprintf('<form action="%s" method="%s">', $action, $method);
         return new self();
    }



    public static function closing()
    {
        echo '</form>';
    }



    public function field(Model $model, string $attribute)
    {
        return (new Field($model, $attribute));
    }
}