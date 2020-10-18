<?php 

namespace app\core;

use app\core\Application;


abstract class Controller{


    public string $layout = 'main';


    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $view
     * @param array $params
     */
    protected function render(string $view, array $params = [] )
    {
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * @param string $key
     * @param string $message
     */
    protected function addFlashMessage(string $key, string $message)
    {
       return  Application::$app->session->setFlashMessage($key, $message);
    }

    /**
     * @param string $path
     */
    protected function redirectTo(string $path)
    {
        Application::$app->response->redirect($path);

    }

}