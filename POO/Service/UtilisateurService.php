<?php

include_once(__DIR__ . "/../DAO/UtilisateurDAO.php");

class UtilisateurService
{
    function insererUser(Utilisateur $obj): void
    {
        $objDAO = new UtilisateurDAO;
        $objDAO->insererUser($obj);
    }
    function updateUser(Utilisateur $obj, int $id): void
    {
        $objDAO = new UtilisateurDAO;
        $objDAO->updateUser($obj, $id);
    }

    function selectAllById($id): Utilisateur
    {
        $UtilisateurDAO = new UtilisateurDAO;
        $Utilisateur = $UtilisateurDAO->selectAllById($id);
        return $Utilisateur;
    }

    function supprimeUser(int $id): void
    {
        $objDAO = new UtilisateurDAO;
        $objDAO->supprimeUser($id);
    }
}
