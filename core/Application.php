<?php 

namespace app\core;

use app\models\User;
use app\Seed;

class Application {


    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public ?Controller $controller = null;
    public Database $database;
    public Seed $seed;

    public ?User $user = null;
    public   $userClass ;

    public static Application $app;
    public static string $ROOT_DIRECTORY ;
    public string $layout = "main";




    public function __construct(string $rootPath, array $config)
    {
        $this->userClass = $config['user'] ;
        self::$ROOT_DIRECTORY = $rootPath;
        self::$app = $this; //

        $this->request =  new Request();
        $this->response = new Response();
        $this->session =  new  Session();

        $this->database = new Database($config['database']);
        $this->seed = new Seed($this->database);

        $user_id = $this->session->get('user');

        if($user_id){
            $this->user = $this->userClass::getUser(['id'=> $user_id]); //We can access from any entrypoint;
           // Helper::dump($this->user);
        }else{
            $this->user = null;
        }

        $this->router = new Router($this->request, $this->response); //router need instance request and response
    }


    public function login(User $user)
    {
        $this->user = $user;
        $this->session->set('user', $user->id);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
        return true;
    }


    public static function isGuest()
    {
        return !self::$app->user;
    }





    /**
     * App use router meth.
     *
     */
    public function run()
    {
        $this->router->resolve(); //router must to find path into list and dispatch(call callback)
    }



}