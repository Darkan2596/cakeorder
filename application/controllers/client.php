<?php

namespace application\controllers;

// header('Content-Type: application/json');

include_once '../libraries/Autoloader.php';



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

function rechercher() {
    if (isset($_POST["keyword"])) {
        $keyword = htmlspecialchars($_POST["keyword"]);
        $PDOFactory = new \PDOFactory("mysql:host=localhost;dbname=cakeorder", $user = "root", $pwd = "", true);
        $AcheteurManager = new \AcheteurManager($PDOFactory->getPDO());
        $listeAcheteurs = $AcheteurManager->get($keyword);
        if (!empty($listeAcheteurs)):
            echo json_encode($listeAcheteurs);
        else:
            echo json_encode(false);
        endif;
    }
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "suppression":
            break;
        case "rechercher":
            rechercher();
            break;
        default:
            break;
    }
}

