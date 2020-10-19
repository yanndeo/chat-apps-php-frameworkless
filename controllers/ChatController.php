<?php


namespace app\controllers;


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




    public function sendMessage($id, Request $request)
    {
        Helper::dump($id);die;
        //init message object
        $message = new Message();
        //check if post
        if ($request->isPost()){
            $message->loadData($request->getBody());
               //$this->manager->save($message);
               $users = $this->userManager->findAllOnline();
            Helper::dump($message);die;


            //load all messages to - from
            $this->setLayout('chat');
            return $this->render('index',[ 'model' => $message, 'users'=> $users ]);
        }

        $this->setLayout('chat');
        return $this->render('index',[ 'model' => $message ]);


    }
}