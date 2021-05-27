<?php

include_once(__DIR__ . "/../DAO/UtilisateurDAO.php");

class UtilisateurService
{
    function insererUtilisateur(Utilisateur $obj): void
    {
        $MDPHash = password_hash($obj->getMdpHash(), PASSWORD_DEFAULT);
        $obj->setMdpHash($MDPHash);
        $objDAO = new UtilisateurDAO;
        $objDAO->insererUtilisateur($obj);
    }
    function updateUtilisateur(Utilisateur $obj, int $id): void
    {
        $objDAO = new UtilisateurDAO;
        $objDAO->updateUtilisateur($obj, $id);
    }

    function selectAllById($id): Utilisateur
    {
        $UtilisateurDAO = new UtilisateurDAO;
        $Utilisateur = $UtilisateurDAO->selectAllById($id);
        return $Utilisateur;
    }

    function selectAllByMail($mail): Utilisateur
    {
        $UtilisateurDAO = new UtilisateurDAO;
        $Utilisateur = $UtilisateurDAO->selectAllByMail($mail);
        return $Utilisateur;
    }

    function supprimeUtilisateur(int $id): void
    {
        $objDAO = new UtilisateurDAO;
        $objDAO->supprimeUtilisateur($id);
    }

    public function listeMail(): ?array
    {
        $UserDAO = new UtilisateurDAO;
        $Utilisateur = $UserDAO->listeMail();
        return $Utilisateur;
    }
}
