<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/TagService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");


session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] != "user") {
    header("location: connexion.php");
}

$objService = new EvenementService;
$objPost = new Evenement;


$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

// if (isset($_GET["id"])) {
$id = $_GET["id"];
$data = $objService->selectAllEventById($id);
// }


$messages = [];
$nomEvenRegex = "#^[0-9\p{L}\s'-]*$#";
$dateEventRegex = "#^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$#";
$heureEventRegex = "^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$";
$lieuEventRegex = "#^[0-9\p{L}\s'-]*$#";
$descriptionRegex = "#^[0-9\p{L}\s'-]*$#";
$urlLienRegex = "#^(http\:\/\/[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$#";
$tagRegex = "#^\#[\w_]{3,29}$#";

if (!empty($_POST)) {

    if (!isset($_POST["nomEvent"]) || empty($_POST["nomEvent"]) || !preg_match($nomEvenRegex, $_POST["nom"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }
    if (!isset($_POST["dateEvent"]) || empty($_POST["dateEvent"]) || !preg_match($dateEventRegex, $_POST["dateEvent"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la date";
    }
    if (!isset($_POST["heureEvent"]) || empty($_POST["heureEvent"]) || !preg_match($heureEventRegex, $_POST["heureEvent"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du l'heure";
    }
    if (!isset($_POST["lieuEvent"]) || empty($_POST["lieuEvent"]) || !preg_match($lieuEventRegex, $_POST["lieuEvent"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du lieu";
    }

    if (!isset($_POST["description"]) || empty($_POST["description"]) || !preg_match($descriptionRegex, $_POST["description"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la description";
    }

    if (!isset($_FILES) || empty($_FILES)) {
        $isThereError = true;
        $messages[] = "Pas d'images à charger";
    }
    if (!isset($_POST["urlLien"]) || empty($_POST["urlLien"]) || !preg_match($urlLienRegex, $_POST["urlLien"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'url";
    }


    if (!$isThereError) {

        if (empty($_FILES['image']['tmp_name'])) {
            $image = $data->getImage();
        } else {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        }

        $objPost->setNom($_POST["nom"]);
        $objPost->setDate($_POST["date"]);
        $objPost->setHeure($_POST["heure"]);
        $objPost->setLieu($_POST["lieu"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setImage($image);
        $objPost->setUrlLien($_POST["urlLien"]);
        $objPost->setIdOrga($_SESSION["idOrga"]);


        $objService->updateEvent($objPost, $id);


        header("location: AffichageEvent.php?id=" . $id);
    }
}
afficherFormModifEvent($isThereError, $messages, $data);
