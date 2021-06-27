<?php

include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");

$erreur = false;
$messageErreur = [];
$objUser = new UtilisateurService;
$tabMail = $objUser->listeMail();

if (isset($_GET["status"])) {
    if ($_GET["status"] == 1) {
        echo "Vous n'êtes pas inscrit ";
    }
}

$token = bin2hex(random_bytes(20));
$_SESSION["csrf_token"] = $token;

if ($_POST) {
    if ($_SESSION["csrf_token"] == $_POST["csrf_token"]) {

        if (!isset($_POST["mailUser"]) || empty($_POST["mailUser"])) {
            $erreur = true;
            $messageErreur[] = "Erreur de saisie : mail non-valide ";
        }


        if (isset($tabMail)) {

            if (in_array($_POST["mailUser"], $tabMail)) {
                $erreur = true;
                $messageErreur[] = "Mail déjà enregistré. Connectez vous.";
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
            try {
                $objUser->insererUtilisateur($objProfil);
            } catch (UserExceptionService $exc) {
                echo $exc->getMessage();
            }
            try {
                $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);
            } catch (UserExceptionService $exc) {
                echo $exc->getMessage();
            }
            session_start();
            $_SESSION["idUser"] = $dataUser->getIdUSer();
            $_SESSION["nom"] = $dataUser->getMailUser();
            $_SESSION["profil"] = $dataUser->getProfil();

            header("location:FormOrgaInsert.php");
        }
    } else {
        $erreur = true;
        $messageErreur[] = "Token invalide";
    }
}

afficherInscr($erreur, $messageErreur, $token);
