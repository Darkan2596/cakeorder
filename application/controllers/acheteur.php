<?php

namespace application\controllers;

//header('Content-Type: application/json');

include_once '../libraries/Autoloader.php';



// \Autoloader::register();

function extractDataFromForm($superGlobal): array {
    foreach ($superGlobal as $key => $value) {
        $datas[str_replace("_utlstr", "", $key)] = $value;
    }
    return $datas;
}

function getAcheteurById() {
    if (isset($_POST))
        echo json_encode($_POST);
    $PDO = new \PDOFactory("mysql:host=localhost;dbname=cakeorder", $user = "root", $pwd = "", true);
    
    $Acheteur = new \Acheteur($datas);


//    var_dump($PDO->getPDO());
    //var_dump($Acheteur);
    $AcheteurManager = new \AcheteurManager($PDO->getPDO());
    $AcheteurManager->add($Acheteur);
}

switch ($_POST['action']) {
    case "inscription":
        inscrire();
        break;
    case "suppression":

        break;
    default:
//home();
        break;
}



