<?php

include_once(__DIR__ . "/../DAO/AssocTagEventDAO.php");

class AssocTagEventService
{
    public function insertAssoc(AssocTagEvent $assoc)
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $assocTagEventDAO->insertAssoc($assoc);
    }

    public function selectEventByTagId(int $id): array
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $listEvent = $assocTagEventDAO->selectEventByTagId($id);

        return $listEvent;
    }

    public function selectTagListByEvent(int $id): array
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $listTag = $assocTagEventDAO->selectTagListByEvent($id);

        return $listTag;
    }

    public function selectAssocByIdEvent(int $id): array
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $listAssoc = $assocTagEventDAO->selectAssocByIdEvent($id);

        return $listAssoc;
    }

    public function deleteAssoc(int $id)
    {
        $assocDAO = new AssocTagEventDAO;

        $assocDAO->deleteAssoc($id);
    }

    public function numberOfAssocForATag(int $idTag): int
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $nbrAssoc = $assocTagEventDAO->numberOfAssocForATag($idTag);

        return $nbrAssoc;
    }

    public function deleteAssocByIdEvent(int $id)
    {
        $assocDAO = new AssocTagEventDAO;

        $assocDAO->deleteAssocByIdEvent($id);
    }
}
