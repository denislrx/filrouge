<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}

$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

$messages = [];
$nomEvenRegex = "#^[A-Z-'\s]*$#";
$dateEventRegex = "";
$heureEventRegex = "";
$lieuEventRegex = "";
$descriptionRegex = "";
$urlLienRegex = "";


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
        $objService = new EvenementService;
        $objPost = new Evenement;
        $objPost->setNom($_POST["nomEvent"]);
        $objPost->setDate($_POST["dateEvent"]);
        $objPost->setHeure($_POST["heureEvent"]);
        $objPost->setLieu($_POST["lieuEvent"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setImage(file_get_contents($_FILES['image']['tmp_name']));
        $objPost->setUrlLien($_POST["description"]);

        $objService->insertEvent($objPost);
        $objId = $objService->selectAllEventByIdOrga($_SESSION["idOrga"]);

        // header vers page Organisateur créé (avec Get IdUser ?)
        header("location: AffichageEvent.php?id=" . $id);
    }
    afficherFormInsertEvent($isThereError, $messages);
}
