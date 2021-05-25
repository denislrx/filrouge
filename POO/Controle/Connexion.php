<?php
include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");

$erreur = false;
$message = "";
$objUser = new UtilisateurService;

if (!empty($_POST)) {

    $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);



    if (password_verify($_POST["MDP"], $dataUser->getMdpHash())) {
        session_start();
        $_SESSION["Nom"] = $dataUser->getMailUser();
        $_SESSION["Profil"] = $dataUser->getProfil();
        header("location:#####");
    } else {
        $erreur = true;
        $message = "Identification invalide";
    }
}

afficherConex($erreur, $message);
