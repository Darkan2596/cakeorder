<?php

//namespace \application\entities;

/**
 * Description of acheteur
 *
 * @author GRICOLAT Didier
 */
class Acheteur extends Utilisateur implements JsonSerializable {

    private $_dateAnniversaire;
    private $_commandes;

    public function __construct(array $params) {
        $this->_commandes = array();
        $this->hydrate($params);
        $this->setPassword(self::passwordGenerator());
    }

    function hydrate($params) {
        foreach ($params as $key => $value) {
            $method = "set" . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function addCommande(Commande $cmd): array {
        $this->_commandes[] = $cmd;
    }

    function get_commandes() {
        return $this->_commandes;
    }

    function getDateAnniversaire() {
        return $this->_dateAnniversaire;
    }

    function setDateAnniversaire($dateAnniversaire): void {
        $this->_dateAnniversaire = $dateAnniversaire;
    }

    public function jsonSerialize() {
        return ["nom" => $this->getNom(),
            "prenom" => $this->getPrenom(),
            "email" => $this->getEmail(),
            "telephone" => $this->getTelephone(),
            "dateAnniversaire" => $this->getDateAnniversaire()
        ];
    }

}
