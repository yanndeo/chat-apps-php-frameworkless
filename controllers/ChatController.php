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

    public function __construct()
    {
       
    }


    public function showMessages(int $id, Request $request)
    {
       // Helper::dump($id);die;

        if (!Application::isGuest()) {

            $message = new Message();
            //getMessage between $id and user auth
            
            $messageManager = new MessageManager();
            $from = Helper::getUser()->id;
            $to = $id;
            $conversations = $messageManager->getAll($from, $to);
           // Helper::dump($conversations);
           // die;

            $userManager = new UserManager();
            $users = $userManager->findAllOnline();

            $this->setLayout('chat');
            return $this->render('index', ['model' => $message, 'users' => $users]);


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