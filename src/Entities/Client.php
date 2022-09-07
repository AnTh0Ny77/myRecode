<?php

namespace Src\Entities;

class Client{
    
    public $cli__id;

    public $cli__nom;

    public $cli__id_mere;

    public $cli__groupement;

    public $cli__logo;

    public $cli__adr1;

    public $cli__adr2;

    public $cli__cp;

    public $cli__ville;

    public $cli__pays;

    public $cli__tel;

    public $cli__email;

    /**
     * Get the value of cli__id
     */ 
    public function getCli__id()
    {
        return $this->cli__id;
    }

    /**
     * Set the value of cli__id
     *
     * @return  self
     */ 
    public function setCli__id($cli__id)
    {
        $this->cli__id = $cli__id;

        return $this;
    }

    /**
     * Get the value of cli__nom
     */ 
    public function getCli__nom()
    {
        return $this->cli__nom;
    }

    /**
     * Set the value of cli__nom
     *
     * @return  self
     */ 
    public function setCli__nom($cli__nom)
    {
        $this->cli__nom = $cli__nom;

        return $this;
    }

    /**
     * Get the value of cli__id_mere
     */ 
    public function getCli__id_mere()
    {
        return $this->cli__id_mere;
    }

    /**
     * Set the value of cli__id_mere
     *
     * @return  self
     */ 
    public function setCli__id_mere($cli__id_mere)
    {
        $this->cli__id_mere = $cli__id_mere;

        return $this;
    }

    /**
     * Get the value of cli__groupement
     */ 
    public function getCli__groupement()
    {
        return $this->cli__groupement;
    }

    /**
     * Set the value of cli__groupement
     *
     * @return  self
     */ 
    public function setCli__groupement($cli__groupement)
    {
        $this->cli__groupement = $cli__groupement;

        return $this;
    }

    /**
     * Get the value of cli__logo
     */ 
    public function getCli__logo()
    {
        return $this->cli__logo;
    }

    /**
     * Set the value of cli__logo
     *
     * @return  self
     */ 
    public function setCli__logo($cli__logo)
    {
        $this->cli__logo = $cli__logo;

        return $this;
    }

    /**
     * Get the value of cli__adr1
     */ 
    public function getCli__adr1()
    {
        return $this->cli__adr1;
    }

    /**
     * Set the value of cli__adr1
     *
     * @return  self
     */ 
    public function setCli__adr1($cli__adr1)
    {
        $this->cli__adr1 = $cli__adr1;

        return $this;
    }

    /**
     * Get the value of cli__adr2
     */ 
    public function getCli__adr2()
    {
        return $this->cli__adr2;
    }

    /**
     * Set the value of cli__adr2
     *
     * @return  self
     */ 
    public function setCli__adr2($cli__adr2)
    {
        $this->cli__adr2 = $cli__adr2;

        return $this;
    }

    /**
     * Get the value of cli__cp
     */ 
    public function getCli__cp()
    {
        return $this->cli__cp;
    }

    /**
     * Set the value of cli__cp
     *
     * @return  self
     */ 
    public function setCli__cp($cli__cp)
    {
        $this->cli__cp = $cli__cp;

        return $this;
    }

    /**
     * Get the value of cli__ville
     */ 
    public function getCli__ville()
    {
        return $this->cli__ville;
    }

    /**
     * Set the value of cli__ville
     *
     * @return  self
     */ 
    public function setCli__ville($cli__ville)
    {
        $this->cli__ville = $cli__ville;

        return $this;
    }

    /**
     * Get the value of cli__pays
     */ 
    public function getCli__pays()
    {
        return $this->cli__pays;
    }

    /**
     * Set the value of cli__pays
     *
     * @return  self
     */ 
    public function setCli__pays($cli__pays)
    {
        $this->cli__pays = $cli__pays;

        return $this;
    }

    /**
     * Get the value of cli__tel
     */ 
    public function getCli__tel()
    {
        return $this->cli__tel;
    }

    /**
     * Set the value of cli__tel
     *
     * @return  self
     */ 
    public function setCli__tel($cli__tel)
    {
        $this->cli__tel = $cli__tel;

        return $this;
    }

    /**
     * Get the value of cli__email
     */ 
    public function getCli__email()
    {
        return $this->cli__email;
    }

    /**
     * Set the value of cli__email
     *
     * @return  self
     */ 
    public function setCli__email($cli__email)
    {
        $this->cli__email = $cli__email;

        return $this;
    }
}