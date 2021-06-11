<?php

class Utilisateur
{

    private $idUSer;
    private $mailUser;
    private $mdpHash;
    private $profil;
    private $valide;




    /**
     * Get the value of idUSer
     */
    public function getIdUSer(): int
    {
        return $this->idUSer;
    }

    /**
     * Set the value of idUSer
     *
     * @return  self
     */
    public function setIdUSer(int $idUSer)
    {
        $this->idUSer = $idUSer;

        return $this;
    }

    /**
     * Get the value of mailUser
     */
    public function getMailUser(): string
    {
        return $this->mailUser;
    }

    /**
     * Set the value of mailUser
     *
     * @return  self
     */
    public function setMailUser(string $mailUser)
    {
        $this->mailUser = $mailUser;

        return $this;
    }

    /**
     * Get the value of mdpHash
     */
    public function getMdpHash(): string
    {
        return $this->mdpHash;
    }

    /**
     * Set the value of mdpHash
     *
     * @return  self
     */
    public function setMdpHash(string $mdpHash)
    {
        $this->mdpHash = $mdpHash;

        return $this;
    }

    /**
     * Get the value of profil
     */
    public function getProfil(): string
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     *
     * @return  self
     */
    public function setProfil(string $profil)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get the value of valide
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * Set the value of valide
     *
     * @return  self
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }
}
