<?php

namespace App\Models;

use App\Database; 


class Message {
     private $_db = null;
    
    public function __construct() {
         $this->_db = Database::getInstance();
    }
    
    
    public function addMessage($message, $userId) {
        
        $stmt = $this->_db->prepare('INSERT INTO message (user_id,message,date) VALUES (:userId, :message, now())');
        $stmt->execute(array(
            ':userId' => $userId,
            ':message' => $message,
        ));
    }
    
    
    public function getAllMessage() {
        $stmt = $this->_db->prepare('SELECT DATE_FORMAT(tm.date,"%d-%m-%Y %H:%i:%s") as dateMessage, tm.message, tu.pseudo FROM message tm INNER JOIN user tu ON tu.id = tm.user_id ORDER BY date DESC');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
