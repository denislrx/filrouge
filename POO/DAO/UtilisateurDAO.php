<?php

include_once("Model/Utilisateur.php");
include_once("ConnexionDAO.php");

class UtilisateurDAO extends ConnexionDAO
{
    function insererUser(Utilisateur $obj): void
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

    function supprimeUser(int $id): void
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

    function updateUser(Utilisateur $obj, int $id): void
    {
        $db = $this->connexion();
        $mail = $obj->getMailUser();
        $mdpHash = $obj->getMdpHash();
        $stmt = $db->prepare("UPDATE utilisateur SET 
                mailUser = ?,
                mdpHash = ?,
                noserv = ?
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
}
