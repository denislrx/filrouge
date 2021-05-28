<?php

include_once(__DIR__ . "/../DAO/EvenementDAO.php");

class EvenementService
{
    public function insertEvent(Evenement $objInsert)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->insertEvent($objInsert);
    }

    public function deleteEvent(int $id)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->deleteEvent($id);
    }

    public function updateEvent(Evenement $objInsert, int $id)
    {
        $evenementDAO = new EvenementDAO;

        $evenementDAO->updateEvent($objInsert, $id);
    }

    public function selectAllEventById(int $id): Evenement
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectAllEventById($id);

        return $evenement;
    }
}
