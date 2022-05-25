<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acheteurManager
 *
 * @author GRICOLAT Didier
 */
class AcheteurManager implements iModel
{

    private $_pdo;

    const INSRT_RQST_UTLSTR = "INSERT INTO utilisateur_tbl (nom_utlstr,prenom_utlstr,email_utlstr,telephone_utlstr,login_utlstr,password_utlstr) "
        . "VALUES (:nom,:prenom,:email,:telephone,:login,:password)";
    const INSRT_RQST_ACTR = "INSERT INTO acheteur_tbl (id_actr,dateAnniversaire_actr) "
        . "VALUES (:id,:dateAnniversaire)";
    const SLCT_RQST_UTLSTR_ACTR_BY = "SELECT nom_utlstr,prenom_utlstr,email_utlstr,telephone_utlstr,login_utlstr,password_utlstr FROM utilisateur_tbl "
        . " JOIN acheteur_tbl WHERE id_utlstr = id_actr AND id_utlstr = :id ";
    const SLCT_RQST_UTLSTR_ACTR_BY_KEYWORD = "SELECT DISTINCT nom_utlstr,prenom_utlstr,email_utlstr,telephone_utlstr,login_utlstr,password_utlstr,dateAnniversaire_actr FROM utilisateur_tbl "
        . " JOIN acheteur_tbl ON id_utlstr = id_actr AND (nom_utlstr regexp :nom OR prenom_utlstr regexp :prenom OR email_utlstr regexp :email OR telephone_utlstr regexp :telephone)";
    public function __construct(\PDO $PDO)
    {
        $this->setPdo($PDO);
    }

    public function add(object $Acheteur): array
    {
        $flag = false;
        $msg = "";
        try {

            //Insertion d'un utilisateur
            $this->getPdo()->beginTransaction(); //Début de la transaction et sortie du mode autocommit
            $statement_utlstr = $this->getPdo()->prepare(self::INSRT_RQST_UTLSTR);
            $statement_utlstr->bindValue(":nom", $Acheteur->getNom(), PDO::PARAM_STR);
            $statement_utlstr->bindValue(":prenom", $Acheteur->getPrenom(), PDO::PARAM_STR);
            $statement_utlstr->bindValue(":email", $Acheteur->getEmail(), PDO::PARAM_STR);
            $statement_utlstr->bindValue(":telephone", $Acheteur->getTelephone(), PDO::PARAM_STR);
            $statement_utlstr->bindValue(":login", $Acheteur->getLogin(), PDO::PARAM_STR);
            $statement_utlstr->bindValue(":password", $Acheteur->getPassword(), PDO::PARAM_STR);
            $statement_utlstr->execute();
            $id = $this->getPdo()->lastInsertId();

            //Insertion d'un acheteur
            $statement_actr = $this->getPdo()->prepare(self::INSRT_RQST_ACTR);
            $statement_actr->bindValue(":id", $id, PDO::PARAM_STR);
            $statement_actr->bindValue(":dateAnniversaire", $Acheteur->getDateAnniversaire(), PDO::PARAM_STR);
            $statement_actr->execute();

            $this->getPdo()->commit(); // Validation des requêtes
        } catch (Exception $exc) {
            $flag = true;
            $msg = $exc->getTraceAsString();
            $this->getPdo()->rollBack(); // Si erreur => annulation des modifications 

        }
        return ["err_flag" => $flag, "error_msg" => $msg];
    }

    public function count($param)
    {
    }

    public function delete($params)
    {
    }

    public function exists($param)
    {
    }
    public function get(string $keyword): array
    {
        $Acheteur = null;
        $listeAcheteurs = array();
        try {
            $statement = $this->getPdo()->prepare(self::SLCT_RQST_UTLSTR_ACTR_BY_KEYWORD);
            $statement->bindValue(":nom", $keyword, PDO::PARAM_STR);
            $statement->bindValue(":prenom", $keyword, PDO::PARAM_STR);
            $statement->bindValue(":email", $keyword, PDO::PARAM_STR);
            $statement->bindValue(":telephone", $keyword, PDO::PARAM_STR);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            while ($tupe = $statement->fetch()) {
                $dataTbTuple = $this->extractDatas($tupe);
                $Acheteur = new Acheteur($dataTbTuple);
                $listeAcheteurs[] = $Acheteur;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $listeAcheteurs;
    }

    public function getById(int $id): Acheteur
    {
        $Acheteur = null;
        try {
            $statement = $this->getPdo()->prepare(self::SLCT_RQST_UTLSTR_ACTR_BY);
            $statement->bindValue(":id", $id, PDO::PARAM_INT);
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();
            $array = $this->extractDatas($statement->fetch());
            $Acheteur = new Acheteur($array);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }

        return $Acheteur;
    }

    public function getList(array $param)
    {
    }

    public function update($params)
    {
    }

    function getPdo()
    {
        return $this->_pdo;
    }

    function setPdo($pdo): void
    {
        $this->_pdo = $pdo;
    }

    function extractDatas($array): array
    {
        $datas = null;
        foreach ($array as $key => $value) {
            $datas[str_replace(array("_utlstr", "_actr"), "", $key)] = $value;
        }
        return $datas;
    }
}
