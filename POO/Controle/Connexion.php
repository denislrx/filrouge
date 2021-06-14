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

$token = bin2hex(random_bytes(20));
$_SESSION["csrf_token"] = $token;

if ($_POST) {
    if ($_SESSION["csrf_token"] == $_POST["csrf_token"]) {
        $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);


        if (password_verify($_POST["MDP"], $dataUser->getMdpHash())) {
            session_start();
            $_SESSION["idUser"] = $dataUser->getIdUser();
            $_SESSION["nom"] = $dataUser->getMailUser();
            $_SESSION["profil"] = $dataUser->getProfil();


            if ($_SESSION["profil"] != "admin") {
                $objId = $objOrga->selectAllOrgaByIdUser($_SESSION["idUser"]);

                if (!is_null($objId)) {
                    $_SESSION["idOrga"] = $objId->getIdOrga();
                } else {
                    header("location: FormOrgaInsert.php");
                }
                header("location:AffichageOrga.php?id=" . $_SESSION["idOrga"]);
            } else {
                header("location:AccueilAgenda.php");
            }
        } else {
            $erreur = true;
            $message = "Identification invalide";
        }
    } else {
        $erreur = true;
        $message = "Token invalide";
    }
}




afficherConex($erreur, $message, $token);
