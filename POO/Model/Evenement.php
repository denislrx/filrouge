<?php

class Evenement
{

    private $idEvent;
    private $date;
    private $heure;
    private $nom;
    private $Lieu;
    private $description;
    private $image;
    private $urlLien;
    private $idOrga;
    private $datePubli;


    /**
     * Get the value of idEvent
     */
    public function getIdEvent(): int
    {
        return $this->idEvent;
    }

    /**
     * Set the value of idEvent
     *
     * @return  self
     */
    public function setIdEvent(int $idEvent)
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of heure
     */
    public function getHeure(): string
    {
        return $this->heure;
    }

    /**
     * Set the value of heure
     *
     * @return  self
     */
    public function setHeure(string $heure)
    {
        $this->heure = $heure;

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
     * Get the value of Lieu
     */
    public function getLieu(): string
    {
        return $this->Lieu;
    }

    /**
     * Set the value of Lieu
     *
     * @return  self
     */
    public function setLieu(string $Lieu)
    {
        $this->Lieu = $Lieu;

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

    /**
     * Get the value of urlLien
     */
    public function getUrlLien(): string
    {
        return $this->urlLien;
    }

    /**
     * Set the value of urlLien
     *
     * @return  self
     */
    public function setUrlLien(string $urlLien)
    {
        $this->urlLien = $urlLien;

        return $this;
    }

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
     * Get the value of datePubli
     */
    public function getDatePubli()
    {
        return $this->datePubli;
    }

    /**
     * Set the value of datePubli
     *
     * @return  self
     */
    public function setDatePubli($datePubli)
    {
        $this->datePubli = $datePubli;

        return $this;
    }
}
