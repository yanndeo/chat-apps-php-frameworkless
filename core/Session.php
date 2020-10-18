<?php
namespace app\core;


class Session
{

    public const KEY_TYPE = [ 'success','danger', 'waring'];

    protected const FLASH_KEY = 'flash_messages';



    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage ){
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        //Helper::dump($flashMessages);
    }



    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage ){
            if($flashMessage['remove']){
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }


    public function setFlashMessage($key, $message)
    {
        $key = strtolower($key);
        if(in_array($key, self::KEY_TYPE)){

            $_SESSION[self::FLASH_KEY][$key] = [
                'remove' => false,
                'value' => $message
            ];
        }

    }

    /**
     * show message by key
     * @param $key
     * @return false|mixed
     */
    public function getFlashMessage($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * show all messages
     * @return mixed
     */
    public  function gellAllFlashMessage()
    {
        return $_SESSION['flash_messages'];
    }

}