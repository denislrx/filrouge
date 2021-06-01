<?php

include_once(__DIR__ . "/../DAO/OrganisateurDAO.php");

class OrganisateurService
{

    public function selectAllOrgaById(int $id): Organisateur
    {
        $orginisateurDAO = new OrganisateurDAO;

        $organisateur = $orginisateurDAO->selectAllOrgaById($id);

        return $organisateur;
    }

    public function selectAllOrgaByIdUser(int $id): Organisateur
    {
        $orginisateurDAO = new OrganisateurDAO;

        $organisateur = $orginisateurDAO->selectAllOrgaByIdUser($id);

        return $organisateur;
    }

    public function updateOrga(Organisateur $objInsert, int $id)
    {
        $organisateurDAO = new OrganisateurDAO;

        $organisateurDAO->updateOrga($objInsert, $id);
    }

    public function insertOrga(Organisateur $objInsert)
    {
        $organisateurDAO = new OrganisateurDAO;

        $organisateurDAO->insertOrga($objInsert);
    }

    public function deleteOrga(int $id)
    {
        $organisateurDAO = new OrganisateurDAO;

        $organisateurDAO->deleteOrga($id);
    }

    public function selectNameByIdOrga(int $id): Organisateur
    {
        $orginisateurDAO = new OrganisateurDAO;

        $organisateur = $orginisateurDAO->selectNameByIdOrga($id);

        return $organisateur;
    }
}
