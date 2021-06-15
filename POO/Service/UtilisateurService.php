<?php

include_once(__DIR__ . "/../DAO/UtilisateurDAO.php");
include_once(__DIR__ . "/../Exception/UserExceptionService.php");

class UtilisateurService
{
    private $utilisateurDAO;

    public function __construct()
    {
        $this->ustilisateurDAO = new UtilisateurDAO;
    }

    function insererUtilisateur(Utilisateur $obj): void
    {
        $MDPHash = password_hash($obj->getMdpHash(), PASSWORD_DEFAULT);
        $obj->setMdpHash($MDPHash);
        try {
            $this->utilisateurDAO->insererUtilisateur($obj);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
    }

    function selectAllById($id): Utilisateur
    {
        try {
            $utilisateur = $this->utilisateurDAO->selectAllById($id);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
        return $utilisateur;
    }

    function selectAllByMail($mail): Utilisateur
    {
        try {
            $utilisateur = $this->utilisateurDAO->selectAllByMail($mail);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
        return $utilisateur;
    }

    function supprimeUtilisateur(int $id): void
    {
        try {
            $this->utilisateurDAO->supprimeUtilisateur($id);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
    }

    public function listeMail(): ?array
    {
        try {
            $utilisateur = $this->utilisateurDAO->listeMail();
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
        return $utilisateur;
    }

    function validate(int $id): void
    {
        try {
            $this->objDAO->validate($id);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
    }

    function getIdUserByIdOrga(int $idOrga): int
    {
        try {
            $idUser = $this->utilisateurDAO->getIdUserByIdOrga($idOrga);
        } catch (UserExceptionDAO $exc) {
            throw new UserExceptionService($exc->getMessage());
        }
        return $idUser;
    }
}
