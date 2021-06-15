<?php

include_once(__DIR__ . "/../DAO/EvenementDAO.php");
include_once(__DIR__ . "/../Exception/EventExceptionService.php");

class EvenementService
{
    private $evenementDAO;

    public function __construct()
    {
        $this->evenementDAO = new EvenementDAO ;
    }

    public function insertEvent(Evenement $objInsert): int
    {
        try {
            $id = $this->evenementDAO->insertEvent($objInsert);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }

        return $id;
    }

    public function deleteEvent(int $id)
    {

        try {
            $this->evenementDAO->deleteEvent($id);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }
    }

    public function updateEvent(Evenement $objInsert, int $id)
    {

        try {
            $this->evenementDAO->updateEvent($objInsert, $id);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }
    }

    public function selectAllEventById(int $id): Evenement
    {
        try {
            $evenement = $this->evenementDAO->selectAllEventById($id);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }

        return $evenement;
    }

    public function selectAllIncomingEventsOfAnEvent(int $id): array
    {
        try {
            $evenement = $this->evenementDAO->selectAllIncomingEventsOfAnEvent($id);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }

        return $evenement;
    }
    public function selectAllEventsOfWeek(): array
    {
        try {
            $evenement = $this->evenementDAO->selectAllEventsOfWeek();
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }


        return $evenement;
    }
    public function listOfMostActivIdOrga(): array
    {
        try {
            $evenement = $this->evenementDAO->listOfMostActivIdOrga();
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }

        return $evenement;
    }

    function selectEventByIdOrga(int $id): array
    {
        try {
            $evenement = $this->evenementDAO->selectEventByIdOrga($id);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }

        return $evenement;
    }

    public function selectLastPublishedEvent()
    {

        try {
            $evenement = $this->evenementDAO->selectLastPublishedEvent();
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }
        return $evenement;
    }

    function selectEventsByDate(string $date): array
    {
        try {
            $evenement = $this->evenementDAO->selectEventsByDate($date);
        } catch (EventExceptionDAO $exc) {
            throw new EventExceptionService($exc->getMessage());
        }
        return $evenement;
    }
}
