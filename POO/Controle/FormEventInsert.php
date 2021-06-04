<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");

session_start();
if (!isset($_SESSION)) {
    header("location: connexion.php");
}

$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

$messages = [];

$nomEventRegex = "#^[0-9\p{L}\s'-]*$#";
$dateEventRegex = "#^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$#";
$heureEventRegex = "^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$";
$lieuEventRegex = "#^[0-9\p{L}\s'-]*$#";
$descriptionRegex = "#^[0-9\p{L}\s'-]*$#";
$urlLienRegex = "#^(http\:\/\/[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$#";


if (!empty($_POST)) {

    if (!isset($_POST["nomEvent"]) || empty($_POST["nom"]) || !preg_match($nomEventRegex, $_POST["heureNom"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }
    if (!isset($_POST["dateEvent"]) || empty($_POST["date"]) || !preg_match($dateEventRegex, $_POST["date"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la date";
    }
    if (!isset($_POST["heureEvent"]) || empty($_POST["heure"]) || !preg_match($heureEventRegex, $_POST["heure"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du l'heure";
    }
    if (!isset($_POST["lieuEvent"]) || empty($_POST["lieu"]) || !preg_match($lieuEventRegex, $_POST["lieu"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du lieu";
    }

    if (!isset($_POST["description"]) || empty($_POST["description"]) || !preg_match($descriptionRegex, $_POST["description"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la description";
    }

    if (!isset($_POST["urlLien"]) || empty($_POST["urlLien"]) || !preg_match($urlLienRegex, $_POST["urlLien"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'url";
    }

    if (!isset($_FILES['image']['tmp_name']) || empty($_FILES['image']['tmp_name'])) {
        $isThereError = true;
        $messages[] = "Pas d'images à charger";
    }

    if (!$isThereError) {
        $objService = new EvenementService;
        $objPost = new Evenement;
        $objPost->setNom($_POST["nomEvent"]);
        $objPost->setDate($_POST["dateEvent"]);
        $objPost->setHeure($_POST["heureEvent"]);
        $objPost->setLieu($_POST["lieuEvent"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setImage(file_get_contents($_FILES['image']['tmp_name']));
        $objPost->setUrlLien($_POST["urlLien"]);
        $objPost->setIdOrga($_SESSION["idOrga"]);

        $objService->insertEvent($objPost);

        $objId = $objService->selectAllEventByIdOrgaNameAndDate($_SESSION["idOrga"], $_POST["nomEvent"], $_POST["dateEvent"]);
        $id = $objId->getIdEvent();
        // header vers page Organisateur créé (avec Get IdUser ?)
        header("location: AffichageEvent.php?id=" . $id);
    }
}
afficherFormInsertEvent($isThereError, $messages);
