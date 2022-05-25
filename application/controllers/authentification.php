<?php

include_once '../libraries/Autoloader.php';

Autoloader::register();

function login() {
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $password = htmlspecialchars($_POST['password']);
    $PDOFactory = new PDOFactory("mysql:host=localhost;dbname=cakeorder", "root", "", true);
    $ManagerCompte = new ManagerAuthentification($PDOFactory->getPDO());
    if ($ManagerCompte->access($identifiant, $password)):
        $datasSession = $ManagerCompte->getDatasSession($identifiant, $password);
        getCurrentSession($datasSession);
        header("Location:http://www.cakeorder.fr/application/views/principal.php");
    else:
        Route::defaultRedirection();
    endif;
}

function getCurrentSession($datasSession): void {
    session_start();
    var_dump($datasSession);
    foreach ($datasSession as $key => $value):
        $_SESSION[$key] = $value;
    endforeach;
    $_SESSION['access_ctrl'] = session_id();
    var_dump($_SESSION);
}

function logout() {
    //Code à ecrire
    unset($_SESSION);
    Route::defaultRedirection();
}

if (isset($_POST['action'])) :
    switch ($_POST['action']) {
        case "login":
            login();
            break;
        case "logout":
            logout();
            break;
        default:
            // Route::defaultRedirection();
            break;
    } else:
    Route::defaultRedirection();
    endif;




    