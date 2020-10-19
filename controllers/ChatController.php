<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Helper;
use app\core\Request;
use app\managers\MessageManager;
use app\models\Message;

class ChatController extends Controller
{
    public MessageManager $manager;

    public function __construct()
    {
        $this->manager = new MessageManager();
    }




    public function sendMessage(Request $request)
    {
        //init message object
        $message = new Message();
        //check if post
        if ($request->isPost()){
            $message->loadData($request->getBody());

        }
        //loaddata from req
        // check if valide
        // save message
        Helper::dump($message->errors);die;
    }
}