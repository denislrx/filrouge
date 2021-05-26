<?php

include_once("DAO/EvenementDAO.php");

class EvenementService
{
    public function insertEvent(Evenement $objInsert)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->insertEvent($objInsert);
    }

    public function deleteOrga(int $id)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->deleteEvent($id);
    }

    public function updateOrga(Evenement $objInsert, int $id)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->updateEvent($objInsert, $id);
    }

    public function selectAllOrgaById(int $id): Evenement
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectAllEventById($id);

        return $evenement;
    }
}
