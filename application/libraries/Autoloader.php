<?php

/**
 * Description of Autoloader
 *
 * @author GRICOLAT Didier
 */
class Autoloader {

    static function register() {
        spl_autoload_register([__CLASS__, "autoloader_class"]);
    }

    static function autoloader_class($className) {

        if (file_exists("../controllers/$className.php"))
            require_once "../controllers/$className.php";

            if (file_exists("../config/$className.php"))
            require_once "../config/$className.php";


            if (file_exists("application/config/$className.php"))
            require_once "application/config/$className.php";
        

        if (file_exists("../entities/$className.php"))
            require_once "../entities/$className.php";

        if (file_exists("../libraries/$className.php"))
            require_once "../libraries/$className.php";

        if (file_exists("../models/$className.php"))
            require_once "../models/$className.php";
    }

}
