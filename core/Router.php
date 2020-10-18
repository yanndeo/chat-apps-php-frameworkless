<?php

namespace app\core;


class Router
{

    public const HTTP_METHODS = ['get', 'post'];

    public const STATUS_CODE = [
        'NOT_FOUND' => 404,
        'ERROR_SERVER' => 500,
    ];

    
    public Request $request;

    public Response $response;

    protected array $routes = [];




    /**
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;   
 
        $this->response = $response;
    }





    /**
     * add route in routes array collection
     * routes['get']
     * @param string $path
     * @param $callback
     * @return void
     */
    public function get(string $path, $callback)
    {
        $this->routes[self::HTTP_METHODS[0]][$path] = $callback;
    }


    /**
     * add route in routes array collection
     * routes['post']
     * @param string $path
     * @param $callback
     * @return void
     */
    public function post(string $path, $callback)
    {
        $this->routes[self::HTTP_METHODS[1]][$path] = $callback;
    }


    /**
     * check matching path
     * and dispatch depending if second param of route is
     * string array ... callable
     */
    public function resolve()
    {
        $path = $this->request->getPath();

        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;  //match or not ?

        //-------------- Dispatch -----------------//
        if($callback === false) {
            $this->response->setStatusCode(self::STATUS_CODE['NOT_FOUND']);
            return $this->renderView('_404');
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        if(is_array($callback)) {
          Application::$app->controller = new $callback[0]();
          $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }




    /**
     * Undocumented function
     *
     * @param string $view
     * @param array $params
     * @return void
     */
    public function renderView(string $view, $params = [])
    {
        $search = '{{content}}';
        $layout_content = $this->layoutContent();
        $view_content = $this->viewContent($view, $params);

        echo str_replace($search, $view_content, $layout_content);
    }



    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIRECTORY . "/views/layout/$layout.html.php";
        $content = ob_get_clean();
        return $content;
    }


    public function renderContent($view_content)
    {
        $layout_content = $this->layoutContent();
        return str_replace('{{content}}', $view_content, $layout_content);
    }


    protected function viewContent(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value; //variable dynamic .Each value $key, becomes $variable. 
        }
        ob_start();
        include_once Application::$ROOT_DIRECTORY . '/views/' . $view . '.html.php';
        $content = ob_get_clean();
        return $content;
    }
}
