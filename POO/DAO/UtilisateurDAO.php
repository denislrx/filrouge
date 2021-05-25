<?php

include_once(__DIR__ . "/..Model/Utilisateur.php");
include_once("ConnexionDAO.php");

class UtilisateurDAO extends ConnexionDAO
{
    function insererUtilisateur(Utilisateur $obj): void
    {
        $db = $this->connexion();;
        $id = $obj->getIdUSer();
        $mail = $obj->getMailUser();
        $mdpHash = $obj->getMdpHash();
        $profil = $obj->getMdpHash();
        $stmt = $db->prepare("INSERT INTO utilisateur (idUser, mailUser, mdpHash, Profil) 
    VALUES (?, ?, ?, ?);");
        $stmt->bind_param("isss", $id, $mail, $mdpHash, $profil);
        $stmt->execute();
        $db->close();
    }


    function selectAllById($id): Utilisateur
    {
        $db = $this->connexion();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE idUser = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rs = $stmt->get_result();
        $dataUtilisateur = $rs->fetch_array(MYSQLI_ASSOC);
        $obj = new Utilisateur;
        $obj->setIdUser($dataUtilisateur["idUser"]);
        $obj->setMailUser($dataUtilisateur["mailUser"]);
        $obj->setMdpHash($dataUtilisateur["mdpHash"]);
        $obj->setProfil($dataUtilisateur["Profil"]);
        $db->close();
        return $obj;
    }

    function selectAllByMail($mail): Utilisateur
    {
        $db = $this->connexion();
        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE mailUser = ?");
        $stmt->bind_param("i", $mail);
        $stmt->execute();
        $rs = $stmt->get_result();
        $dataUtilisateur = $rs->fetch_array(MYSQLI_ASSOC);
        $obj = new Utilisateur;
        $obj->setIdUser($dataUtilisateur["idUser"]);
        $obj->setMailUser($dataUtilisateur["mailUser"]);
        $obj->setMdpHash($dataUtilisateur["mdpHash"]);
        $obj->setProfil($dataUtilisateur["Profil"]);
        $db->close();
        return $obj;
    }

    function supprimeUtilisateur(int $id): void
    {
        $db = $this->connexion();
        $stmt = $db->prepare("DELETE FROM utilisateur WHERE idUser = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }

    function deconnexionSession()
    {
        session_start();
        unset($_SESSION["mailUser"]);
        session_destroy();
        header("location: index.php");
    }

    function updateUtilisateur(Utilisateur $obj, int $id): void
    {
        $db = $this->connexion();
        $mail = $obj->getMailUser();
        $mdpHash = $obj->getMdpHash();
        $stmt = $db->prepare("UPDATE utilisateur SET 
                mailUser = ?,
                mdpHash = ?
                WHERE idUser = ?;");
        $stmt->bind_param(
            "ssi",
            $mail,
            $mdpHash,
            $id
        );
        $stmt->execute();
        mysqli_close($db);
    }

    function listeMail()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT DISTINCT mailUser from utilisateur;");
        $stmt->execute();
        $result = $stmt->get_result();
        $tabMail = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        return  $tabMail;
    }
}
