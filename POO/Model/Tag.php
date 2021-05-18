<?php

class Tag
{
    private $idTag;
    private $nomTag;


    /**
     * Get the value of idTag
     */
    public function getIdTag(): int
    {
        return $this->idTag;
    }

    /**
     * Set the value of idTag
     *
     * @return  self
     */
    public function setIdTag(int $idTag)
    {
        $this->idTag = $idTag;

        return $this;
    }

    /**
     * Get the value of nomTag
     */
    public function getNomTag(): string
    {
        return $this->nomTag;
    }

    /**
     * Set the value of nomTag
     *
     * @return  self
     */
    public function setNomTag(string $nomTag)
    {
        $this->nomTag = $nomTag;

        return $this;
    }
}
