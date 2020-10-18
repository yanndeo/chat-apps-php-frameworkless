<?php 

namespace app\core;

use app\core\Application;


abstract class Controller{


    public string $layout = 'main';


    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    protected function render(string $view, array $params = [] )
    {
        return Application::$app->router->renderView($view, $params);
    }

}