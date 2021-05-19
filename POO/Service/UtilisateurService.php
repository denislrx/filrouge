<?php

include_once("DAO/UtilisateurDAO.php");

class UtilisateurService
{
    public function insererUser(Utilisateur $obj): void
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
}
