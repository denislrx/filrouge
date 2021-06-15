<?php

include_once(__DIR__ . "/../DAO/AssocTagEventDAO.php");
include_once(__DIR__ . "/../Exception/AssocExceptionService.php");

class AssocTagEventService
{
    private $assocTagEventDAO;

    public function __construct()
    {
        try {
            $this->assocTagEventDAO = new AssocTagEventDAO;
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }
    }

    public function insertAssoc(AssocTagEvent $assoc)
    {
        try {
            $this->assocTagEventDAO->insertAssoc($assoc);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }
    }

    public function selectEventByTagId(int $id): array
    {
        try {
            $listEvent = $this->assocTagEventDAO->selectEventByTagId($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $listEvent;
    }

    public function selectTagListByEvent(int $id): array
    {

        try {
            $listTag = $this->assocTagEventDAO->selectTagListByEvent($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $listTag;
    }

    public function selectAssocByIdEvent(int $id): array
    {
        try {
            $listAssoc = $this->assocTagEventDAO->selectAssocByIdEvent($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $listAssoc;
    }

    public function deleteAssoc(int $id)
    {
        try {
            $this->assocTagEventDAO->deleteAssoc($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }
    }

    public function numberOfAssocForATag(int $idTag): int
    {
        try {
            $nbrAssoc = $this->assocTagEventDAO->numberOfAssocForATag($idTag);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $nbrAssoc;
    }

    public function deleteAssocByIdEvent(int $id)
    {

        try {
            $this->assocTagEventDAO->deleteAssocByIdEvent($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }
    }

    public function selectTenMoreFrequentTags()
    {

        try {
            $tabObjTag = $this->assocTagEventDAO->selectTenMoreFrequentTags();
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $tabObjTag;
    }

    public function selectEventByTagName(string $name): array
    {
        try {
            $tabObjEvent = $this->assocTagEventDAO->selectEventByTagName($name);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $tabObjEvent;
    }
}
