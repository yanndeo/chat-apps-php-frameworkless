<?php

require __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../.env.php';


use app\controllers\AuthController;
use app\controllers\ChatController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\Router;

use app\core\Autoloader;
use app\core\Helper;

Autoloader::register();


var_dump($config);

//Get data config 
$config = call_user_func($config);
//Helper::dump($config);
// root path folder
$rootPath = dirname(__DIR__);

//Helper::dump($rootPath);

//init app and all dependencies
$app = new Application($rootPath, $config);

//load seed [create table if not exist]
$app->seed->loadSeed();




//define all routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/chat', [SiteController::class, 'chat']);

$app->router->get('/message/with/:id', [ChatController::class, 'sendMessage']);
$app->router->post('/chat', [ChatController::class, 'sendMessage']);


$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/logout', [AuthController::class, 'logout']);



//start app
$app->run();

