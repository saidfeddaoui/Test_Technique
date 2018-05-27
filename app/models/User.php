<?php

namespace App\Models;

use App\Database; 


class User {

    private $_db = null;
    
    public function __construct() {
         $this->_db = Database::getInstance();
    }
        
    
    public  function createUser($pseudo, $password) {

        $stmt = $this->_db->prepare('INSERT INTO user (pseudo,password,statut) VALUES (:pseudo, :password, :statut)');
        $stmt->execute(array(
            ':pseudo' => $pseudo,
            ':password' => $password,
            ':statut' => 1
        ));
    }


    public function updateUser($pseudo, $connected) {
        $stmt = $this->_db->prepare("UPDATE user SET statut = :statut WHERE pseudo = :pseudo");
        $stmt->execute(array(
            ':pseudo' => $pseudo,
            ':statut' =>$connected
        ));
    }

    
    public function getUser($pseudo, $password) {
            
        try {
            $stmt = $this->_db->prepare('SELECT * FROM user WHERE pseudo = :pseudo AND password = :password');
            $stmt->execute(array(':pseudo' => $pseudo,':password' => $password));
            return $stmt->fetch();
        } catch (PDOException $e) {
            
        }
    }
    
    
    public function getUserByPseudo($pseudo) {
              
       
        try {
            $stmt = $this->_db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
            $stmt->execute(array(':pseudo' => $pseudo));
            return $stmt->fetch();
        } catch (PDOException $e) {
            
        }
    }

    
    public function getAllUsersConnected() {
        try {
            $stmt = $this->_db->prepare('SELECT pseudo,statut FROM user WHERE statut  = :statut');
            $stmt->execute(array(':statut' => 1));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            
        }
    }

}
