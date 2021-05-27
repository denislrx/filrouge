<?php

include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");

$erreur = false;
$messageErreur = [];
$objUser = new UtilisateurService;
$tabMail = $objUser->listeMail();

if (!empty($_POST)) {


    if (!isset($_POST["mailUser"]) || empty($_POST["mailUser"])) {
        $erreur = true;
        $messageErreur[] = "Erreur de saisie : mail non-valide ";
    }


    if (isset($tabMail)) {
        foreach ($tabMail as $mail) {
            if ($_POST["mailUser"] == $mail["mailUser"]) {
                $erreur = true;
                $messageErreur[] = "Mail déjà utilisé";
            }
        }
    }


    if (!isset($_POST["MDP1"]) || empty($_POST["MDP1"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une première fois";
    }

    if (!isset($_POST["MDP2"]) || empty($_POST["MDP2"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une seconde fois";
    }

    if ($_POST["MDP1"] == $_POST["MDP2"]) {
        $MDP = password_hash($_POST["MDP1"], PASSWORD_DEFAULT);
    } else {
        $erreur = true;
        $messageErreur[] = "Les deux saisies de mots de passe ne correspondent pas";
    }




    if (!$erreur) {
        $objProfil = new Utilisateur;
        $objProfil->setMailUser($_POST["mailUser"]);
        $objProfil->setMdpHash($_POST["MDP1"]);
        $objUser->insererUtilisateur($objProfil);
        $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);
        session_start();
        $_SESSION["idUser"] = $dataUser->getIdUSer();
        $_SESSION["Nom"] = $dataUser->getMailUser();
        $_SESSION["Profil"] = $dataUser->getProfil();
        header("location:FormOrgaInsert.php");
    }
}

afficherInscr($erreur, $messageErreur, $_POST);
