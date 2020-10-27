<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\Helper;
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
        if (!Application::isGuest()) {

            $userManager = new UserManager();
            $usersConnected = $userManager->findAllOnline();
            $message = new Message();
            $conversations = (new MessageManager())->getMessages( $id);
            $with = $userManager->findOne(['id'=> $id], User::class);

           // $this->setLayout('chat');
            return $this->render('index', [
                    'model' => $message,
                    'users' => $usersConnected,
                    'with' => $with,
                    'conversations' => $conversations], 'chat');
        }
    }




    public function sendMessage(int $id, Request $request)
    {
        if (!Application::isGuest() ) {

            $userManager = new UserManager();
            $users = $userManager->findAllOnline();
            //build form
            $message = new Message();

            if ($request->isAjax()) {
               $data =$request->getBody();
              $isSaved = (new MessageManager())->create($data);


              if ($isSaved === true){
                  $data = json_encode(['message' => 'success', 'data'=> $data]);
                  return  $data;
              }

              $this->addFlashMessage('DANGER', 'unsuccessfully to send message' );

            }

           // $this->setLayout('chat');
            return $this->render('index', ['model' => $message, 'users' => $users], 'chat');
        }
        $this->redirectTo('/login');


    }
}