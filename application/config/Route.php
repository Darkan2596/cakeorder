<?php

//namespace application\config;

/**
 * Description of Route
 *
 * @author GRICOLAT Didier
 */
class Route {

    const DEFAULT = "http://www.cakeorder.fr/application/views/authentification.php";

    function __construct($route = "default") {
        if (isset($route)) {
            switch ($route) {
                case "default":
                    $this->defaultRedirection();
                    break;
                case "suppression":

                    break;
                default:
//home();
                    break;
            }
        }
    }

    static function defaultRedirection() {
        header("Location:" . self::DEFAULT);
    }

    function getDefaulRoad() {
        return $this->_defaulRoad;
    }

    function setDefaulRoad($defaulRoad): void {
        $this->_defaulRoad = $defaulRoad;
    }

}
