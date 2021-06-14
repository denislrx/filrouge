<?php

include_once(__DIR__ . "/../DAO/EvenementDAO.php");

class EvenementService
{
    public function insertEvent(Evenement $objInsert): int
    {
        $evenementDAO = new EvenementDAO;

        $id = $evenementDAO->insertEvent($objInsert);

        return $id;
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

    public function selectAllOrgaEventsOfWeek(int $id): array
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectAllOrgaEventsOfWeek($id);

        return $evenement;
    }
    public function selectAllEventsOfWeek(): array
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectAllEventsOfWeek();

        return $evenement;
    }
    public function listOfMostActivIdOrga(): array
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->listOfMostActivIdOrga();

        return $evenement;
    }

    function selectEventByIdOrga(int $id): array
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectEventByIdOrga($id);

        return $evenement;
    }

    public function selectLastPublishedEvent()
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectLastPublishedEvent();

        return $evenement;
    }

    function selectEventsByDate(string $date): array
    {
        $evenementDAO = new EvenementDAO;

        $evenement = $evenementDAO->selectEventsByDate($date);

        return $evenement;
    }
}
