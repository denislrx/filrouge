<?php

class AssocTagEvent
{

    private Evenement $evenement;
    private Tag $tag;
    private $idAssocTagEvent;

    /**
     * Get the value of Evenement
     */
    public function getEvenement(): Evenement
    {
        return $this->evenement;
    }

    /**
     * Set the value of Evenement
     *
     * @return  self
     */
    public function setEvenement(Evenement $evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get the value of Tag
     */
    public function getTag(): Tag
    {
        return $this->tag;
    }

    /**
     * Set the value of Tag
     *
     * @return  self
     */
    public function setTag(Tag $tag)
    {
        $this->Tag = $tag;

        return $this;
    }

    /**
     * Get the value of idAssocTagEvent
     */
    public function getIdAssocTagEvent(): int
    {
        return $this->idAssocTagEvent;
    }

    /**
     * Set the value of idAssocTagEvent
     *
     * @return  self
     */
    public function setIdAssocTagEvent(int $idAssocTagEvent)
    {
        $this->idAssocTagEvent = $idAssocTagEvent;

        return $this;
    }
}
