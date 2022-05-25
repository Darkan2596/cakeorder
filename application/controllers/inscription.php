<?php

namespace application\controllers;

//header('Content-Type: application/json');

include_once '../libraries/Autoloader.php';

function extractDatasFromForm($superGlobal): array {
    $datas = null;
    foreach ($superGlobal as $key => $value) {
        $datas[str_replace("_utlstr", "", $key)] = $value;
    }
    return $datas;
}

function sp_global_extract_datas_with_pattern(array $super_gb, array $tab_patterns) {
    $tab = $super_gb;
    foreach ($tab_patterns as $pattern) {
        foreach ($tab as $key => $value) {
            if (preg_match($pattern, $key)):
                $tab[preg_replace($pattern, "", $key)] = trim($value);
                unset($tab[$key]);
            endif;
        }
    }
    return $tab;
}

function inscrire(): void {
    if (isset($_POST)) {
        $datas = sp_global_extract_datas_with_pattern($_POST, ["/_utlstr/"]);
        $Acheteur = new \Acheteur($datas);
        $PDOFactory = new \PDOFactory("mysql:host=localhost;dbname=cakeorder", $user = "root", $pwd = "", true);
        $AcheteurManager = new \AcheteurManager($PDOFactory->getPDO());
        $response = $AcheteurManager->add($Acheteur);
       // var_dump($response);
        echo json_encode($response);
    }
}

if (isset($_POST['action'])) {
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
}


