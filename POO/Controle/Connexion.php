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
        header("location:Inscription.php?status=1");
    }
}

if (!empty($_POST)) {
    //var_dump($_POST);
    $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);
    //var_dump($dataUser);



    if (password_verify($_POST["MDP"], $dataUser->getMdpHash())) {
        session_start();
        $_SESSION["idUser"] = $dataUser->getIdUSer();
        $_SESSION["Nom"] = $dataUser->getMailUser();
        $_SESSION["Profil"] = $dataUser->getProfil();
        //var_dump($_SESSION["idUser"]);
        $objId = $objOrga->selectAllOrgaByIdUser($_SESSION["idUser"]);
        $_SESSION["idOrga"] = $objId->getIdOrga();
        //var_dump($_SESSION["idOrga"]);

        header("location:AffichageOrga.php?id=" . $_SESSION["idOrga"]);
    } else {
        $erreur = true;
        $message = "Identification invalide";
    }
}

afficherConex($erreur, $message);
