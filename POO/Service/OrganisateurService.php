<?php

include_once("DAO/OrganisateurDAO.php");

class OrganisateurService
{

    public function selectAllOrgaById(int $id): Organisateur
    {
        $OrganisateurDAO = new OrganisateurDAO;

        $Organisateur = $OrganisateurDAO->selectAllOrgaById($id);

        return $Organisateur;
    }

    public function updateOrga(Organisateur $objInsert, int $id)
    {
        $OrganisateurDAO = new OrganisateurDAO;

        $OrganisateurDAO->updateOrga($objInsert, $id);
    }

    public function insertOrga(Organisateur $objInsert)
    {
        $OrganisateurDAO = new OrganisateurDAO;

        $OrganisateurDAO->insertOrga($objInsert);
    }

    public function deleteOrga(int $id)
    {
        $OrganisateurDAO = new OrganisateurDAO;

        $OrganisateurDAO->deleteOrga($id);
    }
}
