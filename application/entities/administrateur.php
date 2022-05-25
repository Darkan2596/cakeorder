<?php




class administrateur{

    private $_nom;
    private $_prenom;
    private $_identifiant;
    private $_password;


  public function __construct(array $params) {
    $this->_commandes = array();
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


    /**
     * Get the value of _nom
     */ 
    public function getnom()
    {
        return $this->_nom;
    }

    /**
     * Set the value of _nom
     *
     * @return  self
     */ 
    public function setnom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }

    /**
     * Get the value of _prenom
     */ 
    public function getprenom()
    {
        return $this->_prenom;
    }

    /**
     * Set the value of _prenom
     *
     * @return  self
     */ 
    public function setprenom($_prenom)
    {
        $this->_prenom = $_prenom;

        return $this;
    }

    /**
     * Get the value of _identifiant
     */ 
    public function getidentifiant()
    {
        return $this->_identifiant;
    }

    /**
     * Set the value of _identifiant
     *
     * @return  self
     */ 
    public function setidentifiant($_identifiant)
    {
        $this->_identifiant = $_identifiant;

        return $this;
    }

    /**
     * Get the value of _password
     */ 
    public function getpassword()
    {
        return $this->_password;
    }

    /**
     * Set the value of _password
     *
     * @return  self
     */ 
    public function setpassword($_password)
    {
        $this->_password = $_password;

        return $this;
    }
}
