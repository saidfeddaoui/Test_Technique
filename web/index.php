<?php 
require '../app/Autoloader.php';
App\Autoloader::register();




if(basename($_SERVER['REQUEST_URI']) == 'tchat.php') {
    $controller = new App\Controllers\TchatController();
    $controller->tchat();
    //$controller->users_connected();
}elseif(basename($_SERVER['REQUEST_URI']) == 'message.php') {
     $controller = new App\Controllers\TchatController();
     $controller->message();
}elseif (basename($_SERVER['REQUEST_URI']) == 'display.php') {
     $controller = new App\Controllers\TchatController();
     $controller->display();
}elseif (basename($_SERVER['REQUEST_URI']) == 'users_connected.php') {
     $controller = new App\Controllers\TchatController();
     $controller->users_connected();
}
else{
    $controller = new App\Controllers\AuthentificationController();
    $controller->authentification();
}