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

session_start();
$token = bin2hex(random_bytes(20));
if (!$_POST) {
    $_SESSION["csrf_token"] = $token;
};




if ($_POST) {
    if ($_SESSION["csrf_token"] == $_POST["csrf_token"]) {
        try {
            $dataUser = $objUser->selectAllByMail($_POST["mailUser"]);
        } catch (UserExceptionService $exc) {
            echo $exc->getMessage();
        }


        if (password_verify($_POST["MDP"], $dataUser->getMdpHash())) {
            session_start();
            $_SESSION["idUser"] = $dataUser->getIdUser();
            $_SESSION["nom"] = $dataUser->getMailUser();
            $_SESSION["profil"] = $dataUser->getProfil();


            if ($_SESSION["profil"] != "admin") {
                try {
                    $objId = $objOrga->selectAllOrgaByIdUser($_SESSION["idUser"]);
                } catch (OrgaExceptionService $exc) {
                    echo $exc->getMessage();
                }

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
        // var_dump($_SESSION["csrf_token"]);
        // var_dump($_POST["csrf_token"]);
        // var_dump($token);
    }
}



// var_dump($_SESSION["csrf_token"]);
// var_dump($token);
// var_dump($_SESSION);
afficherConex($erreur, $message, $token);
