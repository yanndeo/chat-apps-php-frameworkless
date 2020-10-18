<?php 

namespace app\core;

use app\Seed;

class Application {


    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Controller $controller;
    public Database $database;
    public Seed $seed;

    public static Application $app;
    public static string $ROOT_DIRECTORY ;




    public function __construct(string $rootPath, array $config)
    {
        self::$ROOT_DIRECTORY = $rootPath;
        self::$app = $this; //

        $this->request =  new Request();
        $this->response = new Response();
        $this->session = new  Session();

        $this->database = new Database($config['database']);
        $this->seed = new Seed($this->database);

        $this->router = new Router($this->request, $this->response); //router need instance request and response
    }







    /**
     * App use router meth.
     *
     */
    public function run()
    {
        $this->router->resolve(); //router must to find path into list and dispatch(call callback)
    }

    public function login($user)
    {
    }


}