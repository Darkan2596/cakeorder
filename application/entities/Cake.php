<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Cake{

    private $_id;
    private $_denomination;
    private $_composition;
    private $_description;

    public function __construct(array $array){

        $this->hydrate($array);
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
     * Get the value of _id
     */ 
    public function getid()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */ 
    public function setid($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of _denomination
     */ 
    public function getdenomination()
    {
        return $this->_denomination;
    }

    /**
     * Set the value of _denomination
     *
     * @return  self
     */ 
    public function setdenomination($_denomination)
    {
        $this->_denomination = $_denomination;

        return $this;
    }

    /**
     * Get the value of _composition
     */ 
    public function getcomposition()
    {
        return $this->_composition;
    }

    /**
     * Set the value of _composition
     *
     * @return  self
     */ 
    public function setcomposition($_composition)
    {
        $this->_composition = $_composition;

        return $this;
    }

    /**
     * Get the value of _description
     */ 
    public function getdescription()
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     *
     * @return  self
     */ 
    public function setdescription($_description)
    {
        $this->_description = $_description;

        return $this;
    }

    public function referenceGenerateur(){
        $value = rand(1,9);

        for($cpt=0; $cpt<5;$cpt++){
         $value .=$value;

        }


    }
}
