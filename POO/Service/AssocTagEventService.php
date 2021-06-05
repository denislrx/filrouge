<?php

include_once(__DIR__ . "/../DAO/AssocTagEventDAO.php");

class AssocTagEventService
{
    public function insertAssoc(AssocTagEvent $assoc)
    {
        $assocTagEventDAO = new AssocTagEventDAO;

        $assocTagEventDAO->insertAssoc($assoc);
    }
}
