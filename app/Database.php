<?php

namespace App;

use PDO;

/**
 * Class de connexion à la base
 */
class Database {

   
    private $_connection;
    private static $_instance;
	
        
    private static $DATA = null;


    
    private static function getData() {
        if (self::$DATA !== null) {
            return self::$DATA;
        }
        self::$DATA = parse_ini_file(__DIR__ . '/config.ini');
        
        return self::$DATA;
    }
        
    public static function getInstance() {
	if(!self::$_instance) { 
	    self::$_instance = new self();
	}
	return self::$_instance;
    }
	
    private function __construct() {
        
        $config = self::getData();
        try {
            $this->_connection = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['username'], $config['password']);
            $this->_connection->exec("SET CHARACTER SET utf8");
        }catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
		
    }
        
    public function prepare($sql)
    {
        return $this->_connection->prepare($sql);
    }
}
