<?php

/**
 * Description of ManagerAuthentification
 *
 * @author GRICOLAT Didier
 */
class ManagerAuthentification {

    private $_pdo;

    const SLCT_RQST_UTLSTR_EXIST = "SELECT COUNT(*) as count FROM administrateur_tbl WHERE login_admin=:login AND password_admin = :password";
    const SLCT_RQST_UTLSTR_DATAS = "SELECT nom_admin ,prenom_admin FROM administrateur_tbl WHERE login_admin=:login AND password_admin = :password";

    public function __construct(\PDO $PDO) {
        $this->setPdo($PDO);
    }

    public function access($identifiant, $password) : bool{
        $rspAccess = false;
        $msg = "";
        $count =null;
        try {
            //Insertion d'un utilisateur
            $statement = $this->getPdo()->prepare(self::SLCT_RQST_UTLSTR_EXIST);
            $statement->bindValue(":login", $identifiant, PDO::PARAM_STR);
            $statement->bindValue(":password", $password, PDO::PARAM_STR);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            $count = intval($statement->fetch()['count']);
            if (isset($count) && $count >= 1):
                $rspAccess = true;
            endif;
        } catch (Exception $exc) {
            $msg = $exc->getTraceAsString();
        }
        return $rspAccess;
    }

    public function getDatasSession($identifiant, $password): array {
        $datasUser = null;
        try {
            //Insertion d'un utilisateur
            $statement = $this->getPdo()->prepare(self::SLCT_RQST_UTLSTR_DATAS);
            $statement->bindValue(":login", $identifiant, PDO::PARAM_STR);
            $statement->bindValue(":password", $password, PDO::PARAM_STR);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            $datasUser = $statement->fetch();
        } catch (Exception $exc) {
            print $exc->getTraceAsString();
        }
        return $datasUser;
    }

    function getPdo() {
        return $this->_pdo;
    }

    function setPdo($pdo): void {
        $this->_pdo = $pdo;
    }

}
