<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\managers\MessageManager;
use app\managers\UserManager;
use app\models\Message;
use app\models\User;

class ChatController extends Controller
{

    public function __construct()
    {
       
    }


    public function showMessages(int $id, Request $request)
    {
       // Helper::dump($id);die;
        if (!Application::isGuest()) {
            $userManager = new UserManager();
            $usersConnected = $userManager->findAllOnline();
            $message = new Message();
            $conversations = (new MessageManager())->getMessages( $id);
            $with = $userManager->findOne(['id'=> $id], User::class);

            $this->setLayout('chat');
            return $this->render('index', [
                    'model' => $message,
                    'users' => $usersConnected,
                    'with' => $with,
                    'conversations' => $conversations]);
        }
    }




    public function sendMessage(int $id, Request $request)
    {
        //init message object
        if (!Application::isGuest()) {

            $message = new Message();

            $userManager = new UserManager();
            $users = $userManager->findAllOnline();
            $this->setLayout('chat');

            if ($request->isPost()) {
                $message->loadData($request->getBody());
                //$this->manager->save($message);

                //load all messages to <-> from
                return $this->render('index', ['model' => $message, 'users' => $users]);
            }

            return $this->render('index', ['model' => $message, 'users' => $users]);
        }
        $this->redirectTo('/login');


    }
}