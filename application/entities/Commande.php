<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commande
 *
 * @author didie
 */
class Commande {

    private $_reference;
    private $_dateAchat;
    private $_montantHT;
    private $_montantTTC;
    private $_cakes;

    public function __construct(array $params) {
        $this->_cakes = array();
        $this->hydrate($params);
    }

    function hydrate($params) {
        foreach ($params as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function addCake(Cake $cake) {
        $this->_cakes[] = $cake;
    }

    function getReference() {
        return $this->_reference;
    }

    function getDateAchat() {
        return $this->_dateAchat;
    }

    function getMontantHT() {
        return $this->_montantHT;
    }

    function getMontantTTC() {
        return $this->_montantTTC;
    }

    function getCakes() {
        return $this->_cakes;
    }

    function setReference($reference): void {
        $this->_reference = $reference;
    }

    function setDateAchat($dateAchat): void {
        $this->_dateAchat = $dateAchat;
    }

    function setMontantHT($montantHT): void {
        $this->_montantHT = $montantHT;
    }

    function setMontantTTC($montantTTC): void {
        $this->_montantTTC = $montantTTC;
    }

    function setCakes($cakes): void {
        $this->_cakes = $cakes;
    }

}
