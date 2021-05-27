<?php

class Organisateur
{

    private $idOrga;
    private $nom;
    private $adresse;
    private $codePostal;
    private $ville;
    private $description;
    private $email;
    private $telephone;
    private $adresseTwitter;
    private $adresseInsta;
    private $adresseFB;
    private $adresseSite;
    private $idUser;
    private $image;



    /**
     * Get the value of idOrga
     */
    public function getIdOrga(): int
    {
        return $this->idOrga;
    }

    /**
     * Set the value of idOrga
     *
     * @return  self
     */
    public function setIdOrga(int $idOrga)
    {
        $this->idOrga = $idOrga;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of adresse
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */
    public function setAdresse(?string $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of codePostal
     */
    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    /**
     * Set the value of codePostal
     *
     * @return  self
     */
    public function setCodePostal(?string $codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get the value of ville
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telephone
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */
    public function setTelephone(?string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of adresseTwitter
     */
    public function getAdresseTwitter(): ?string
    {
        return $this->adresseTwitter;
    }

    /**
     * Set the value of adresseTwitter
     *
     * @return  self
     */
    public function setAdresseTwitter(?string $adresseTwitter)
    {
        $this->adresseTwitter = $adresseTwitter;

        return $this;
    }

    /**
     * Get the value of ?adresseInsta
     */
    public function getAdresseInsta(): string
    {
        return $this->adresseInsta;
    }

    /**
     * Set the value of adresseInsta
     *
     * @return  self
     */
    public function setAdresseInsta(?string $adresseInsta)
    {
        $this->adresseInsta = $adresseInsta;

        return $this;
    }

    /**
     * Get the value of adresseFB
     */
    public function getAdresseFB(): ?string
    {
        return $this->adresseFB;
    }

    /**
     * Set the value of adresseFB
     *
     * @return  self
     */
    public function setAdresseFB(?string $adresseFB)
    {
        $this->adresseFB = $adresseFB;

        return $this;
    }

    /**
     * Get the value of adresseSite
     */
    public function getAdresseSite(): ?string
    {
        return $this->adresseSite;
    }

    /**
     * Set the value of adresseSite
     *
     * @return  self
     */
    public function setAdresseSite(?string $adresseSite)
    {
        $this->adresseSite = $adresseSite;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */
    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}
