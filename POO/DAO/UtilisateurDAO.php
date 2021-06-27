<?php

include_once(__DIR__ . "\..\Model\Utilisateur.php");
include_once("ConnexionDAO.php");
include_once(__DIR__ . "/../Exception/UserExceptionDAO.php");

class UtilisateurDAO extends ConnexionDAO
{
    function insererUtilisateur(Utilisateur $obj): void
    {
        try {
            $db = $this->connexion();;
            $mail = $obj->getMailUser();
            $mdpHash = $obj->getMdpHash();
            $stmt = $db->prepare("INSERT INTO utilisateur (mailUser, mdpHash) 
    VALUES (?, ?);");
            $stmt->bind_param("ss", $mail, $mdpHash);
            $stmt->execute();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  insererUtilisateur() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
    }


    function selectAllById($id): Utilisateur
    {
        try {
            $db = $this->connexion();
            $stmt = $db->prepare("SELECT * FROM utilisateur WHERE idUser = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $rs = $stmt->get_result();
            $dataUtilisateur = $rs->fetch_array(MYSQLI_ASSOC);
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectAllById() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }

        $obj = new Utilisateur;
        $obj->setIdUser($dataUtilisateur["idUser"]);
        $obj->setMailUser($dataUtilisateur["mailUser"]);
        $obj->setMdpHash($dataUtilisateur["mdpHash"]);
        $obj->setProfil($dataUtilisateur["Profil"]);
        return $obj;
    }

    function selectAllByMail($mail): Utilisateur
    {
        try {
            $db = $this->connexion();
            $stmt = $db->prepare("SELECT * FROM utilisateur WHERE mailUser = ?");
            $stmt->bind_param("s", $mail);
            $stmt->execute();
            $rs = $stmt->get_result();
            $dataUtilisateur = $rs->fetch_array(MYSQLI_ASSOC);
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectAllByMail() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
        $obj = new Utilisateur;
        $obj->setIdUser($dataUtilisateur["idUser"]);
        $obj->setMailUser($dataUtilisateur["mailUser"]);
        $obj->setMdpHash($dataUtilisateur["mdpHash"]);
        $obj->setProfil($dataUtilisateur["Profil"]);
        return $obj;
    }

    function supprimeUtilisateur(int $id): void
    {
        try {
            $db = $this->connexion();
            $stmt = $db->prepare("DELETE FROM utilisateur WHERE idUser = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction supprimeUtilisateur() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
    }

    function deconnexionSession()
    {
        session_start();
        unset($_SESSION["mailUser"]);
        session_destroy();
        header("location: index.php");
    }


    function listeMail()
    {
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT mailUser from utilisateur;");
            $stmt->execute();
            $result = $stmt->get_result();
            $tabMail = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction listeMail() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }

        return  $tabMail;
    }

    function validate($id)
    {
        try {
            $db = $this->connexion();
            $stmt = $db->prepare("UPDATE utilisateur SET profil = 'user' WHERE idUser= ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction validate() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
    }

    function getIdUserByIdOrga($idOrga)
    {
        try {
            $db = $this->connexion();
            $stmt = $db->prepare("SELECT u.idUser FROM utilisateur as u INNER JOIN organisateur AS o WHERE o.idOrga = ? ");
            $stmt->bind_param("i", $idOrga);
            $stmt->execute();
            $result = $stmt->get_result();
            $idUser = $result->fetch_all(MYSQLI_NUM);
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction getIdUserByIdOrga() ne marche pas";
            throw new UserExceptionDAO($message, $exc->getCode);
        }
        return $idUser[0];
    }
}
