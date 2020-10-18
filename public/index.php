<?php

require __DIR__ . '/../core/Autoloader.php';
require_once __DIR__ . '/../.env.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\core\Router;
use app\models\Test;

use app\core\Autoloader;
use app\core\Helper;

Autoloader::register();


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

//Helper::dump($db);

//define all routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);


//start app
$app->run();

