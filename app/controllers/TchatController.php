<?php

namespace App\Controllers;

use App\Models;

/**
 * 
 */
class TchatController extends AuthentificationController {

    protected $_messaqe;
    protected $_user;

    public function __construct() {
        parent::__construct();
        $this->_messaqe = new Models\Message();
        $this->_user= new Models\User();
    }

    
    public function tchat() {
        
        if (isset($_POST['logout']) && 'Deconnexion' == $_POST['logout']) {
            $this->logout($_SESSION['pseudo']);
        }
        if (isset($_SESSION['pseudo'])) {
            echo $this->render(array(
                    ), '../app/views/tchat.php');
        } else {
            
            $tchat=$this->_user;
            $tchat->updateUser($_SESSION['pseudo'], 0);
            session_destroy();
            header('Location: authentification.php');
        }
    }


    public function message() {
        if (isset($_POST['username']) && isset($_POST['message']) && $_POST['username'] == $_SESSION['pseudo']) {
            $user = parent::getUser()->getUserByPseudo(trim($_SESSION['pseudo']));
            $tchat = $this->_messaqe;
            $tchat->addMessage(htmlentities(strip_tags($_POST['message'])), $user['id']);
        }
    }

    
    public function display() {

        $tchat = $this->_messaqe;

        echo $this->render(array(
            'messageList' => $tchat->getAllMessage()
                ), '../app/views/display.php');
    }

     public function users_connected() {
        echo $this->render(array(
            'listConnected' => parent::ListUsersConnected()
                ), '../app/views/users_connected.php');
    }

    
    public function render($data, $url) {
        extract($data);

        ob_start();
        include($url);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}
