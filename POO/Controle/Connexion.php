<?php
include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

$err = false;
$erreur = false;
$message = "";
$objUser = new UtilisateurService;
$objOrga = new OrganisateurService;
$tabMail = $objUser->listeMail();

if (!empty($_POST["mailUser"])) {
    if (!in_array($_POST["mailUser"], $tabMail)) {
        $erreur = true;
        $message = "Mail inconnu ou invalide";;
    }
}

if (!empty($_POST)) {

    $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);


    if (password_verify($_POST["MDP"], $dataUser->getMdpHash())) {
        session_start();
        $_SESSION["idUser"] = $dataUser->getIdUSer();
        $_SESSION["nom"] = $dataUser->getMailUser();
        $_SESSION["profil"] = $dataUser->getProfil();

        $objId = $objOrga->selectAllOrgaByIdUser($_SESSION["idUser"]);

        if (!is_null($objId)) {
            $_SESSION["idOrga"] = $objId->getIdOrga();
        } else {
            header("location: FormOrgaInsert.php");
        }

        header("location:AffichageOrga.php?id=" . $_SESSION["idOrga"]);
    } else {
        $erreur = true;
        $message = "Identification invalide";
    }
}

afficherConex($erreur, $message);
