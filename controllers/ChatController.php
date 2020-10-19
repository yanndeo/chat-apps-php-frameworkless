<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\managers\MessageManager;
use app\managers\UserManager;
use app\models\Message;

class ChatController extends Controller
{
    public MessageManager $manager;
    public UserManager $userManager;

    public function __construct()
    {
        $this->manager = new MessageManager();
        $this->userManager = new UserManager();
    }




    public function sendMessage(int $id, Request $request)
    {
       // Helper::dump($id);die;
        //init message object
        if (!Application::isGuest()) {

            $message = new Message();

            $users = $this->userManager->findAllOnline();
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