<?php

namespace App\Controllers;

use App\Models;



class AuthentificationController {

    private $_user;

    public function __construct() 
    {
        session_start();
        $this->_user = new Models\User();
    }

    protected function getUser()
    {
        return $this->_user;
    }

    
    public function ListUsersConnected() 
    {
        return $this->_user->getAllUsersConnected();
    }

    
    public function authentification() {

        require '../app/views/authentification.php';

        if(!isset($_SESSION['pseudo'])) {
        if (isset($_POST['chatter']) && 'Envoyer' == $_POST['chatter']) {

            $pseudo = htmlentities(strip_tags(trim($_POST['pseudo'])));
            $password = trim($_POST['password']);
            
          if($this->login($pseudo, $password)){
              header('Location: tchat.php'); 
          }else{
              header('Location: authentification.php?login=error'); 
          }
        }
        }else{
            header('Location: tchat.php');
        }
    }


    public function login($pseudo, $password) {
        
            $userByPseudo = $this->_user->getUserByPseudo($pseudo);
         
            //on verifier si le pseudo est déjà existe en verifier le mot de passe sinon en crée un nouveau compte
            if($userByPseudo && $pseudo==$userByPseudo['pseudo'] ){
                $row = $this->_user->getUser($pseudo, md5($password));
                if ($row) {
                 $_SESSION['pseudo'] = $row['pseudo'];
                 $_SESSION['loggedin'] = true;
            // si on se connecte on vérifie si on etait deconnecté avant
                if ($row['connected'] == 0) {
                $this->_user->updateUser($pseudo, 1);
                 }
                    return true;
                 }else{
                    return false;
                 }
         }else{
             //Création du compte
            $hashPassword = md5($password);
            $this->_user->createUser($pseudo, $hashPassword);

            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['loggedin'] = true;

            return true;
         }

    
    }

    public function logout($pseudo) {
        $this->_user->updateUser($pseudo, 0);
        session_destroy();
        header('Location: authentification.php');
    }

}
