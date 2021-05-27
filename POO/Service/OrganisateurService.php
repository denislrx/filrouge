<?php

include_once(__DIR__ . "/../DAO/OrganisateurDAO.php");

class OrganisateurService
{

    public function selectAllOrgaById(int $id): Organisateur
    {
        $orginisateurDAO = new OrganisateurDAO;

        $orginisateur = $orginisateurDAO->selectAllOrgaById($id);

        return $orginisateur;
    }

    public function updateOrga(Organisateur $objInsert, int $id)
    {
        $orginisateurDAO = new OrganisateurDAO;

        $orginisateurDAO->updateOrga($objInsert, $id);
    }

    public function insertOrga(Organisateur $objInsert)
    {
        $orginisateurDAO = new OrganisateurDAO;

        $orginisateurDAO->insertOrga($objInsert);
    }

    public function deleteOrga(int $id)
    {
        $orginisateurDAO = new OrganisateurDAO;

        $orginisateurDAO->deleteOrga($id);
    }
}
