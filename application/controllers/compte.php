<?php

session_start();

function deconnexion() {
    unset($_REQUEST);
    unset($_SESSION['access_ctrl']);
    session_destroy();
    if (isset($_SESSION)):
        return ['redirect' => false];
    else:
        return ['redirect' => true];
    endif;
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "sigin":
            authenticate();
            break;
        case "logout":
            deconnexion();
            break;
        case "rechercher":
            rechercher();
            break;
        default:
//home();
            break;
    }
}

