<?php

/**
 * Description of utilisateur
 *
 * @author GRICOLAT Didier
 */
abstract class Utilisateur {

    protected $_id;
    protected $_nom;
    protected $_prenom;
    protected $_email;
    protected $_telephone;
    protected $_login;
    protected $_password;

    static function passwordGenerator() {
        //return random_bytes(15);
        return uniqid();
    }

    function getId() {
        return $this->_id;
    }

    function getNom() {
        return $this->_nom;
    }

    function getPrenom() {
        return $this->_prenom;
    }

    function getEmail() {
        return $this->_email;
    }

    function getTelephone() {
        return $this->_telephone;
    }

    function getLogin() {
        return $this->_login;
    }

    function getPassword() {
        return $this->_password;
    }

    function setId($id): void {
        $this->_id = $id;
    }

    function setNom($nom): void {
        $this->_nom = $nom;
    }

    function setPrenom($prenom): void {
        $this->_prenom = $prenom;
    }

    function setEmail($email): void {
        $this->_email = $email;
        $this->setLogin($email);
    }

    function setTelephone($telephone): void {
        $this->_telephone = $telephone;
    }

    function setLogin($login): void {
        $this->_login = $login;
    }

    function setPassword($password): void {
        $this->_password = $password;
    }

}
