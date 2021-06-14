<?php

include_once(__DIR__ . "/../Presentation/AgendaPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");

$profil = "";
session_start();

if (isset($_SESSION["profil"])) {
    $profil = $_SESSION;
}

$objOrga = new OrganisateurService;
$objEvent = new EvenementService;
$objAssoc = new AssocTagEventService;

$tagRegex = "#^\#[\w_]{3,29}$#";
$dateEventRegex = "#^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#";
$nomRegex = "#^[0-9\p{L}\s'-]*$#";

$erreur = true;
$message = [];

if (!empty($_POST)) {
    if (isset($_POST["orgaResearch"])) {
        if (preg_match($nomRegex, $_POST["orgaResearch"])) {
            $id = $objOrga->selectIdOrgaByName($_POST["orgaResearch"]);
            header("location : AffichageOrga.php?id=$id");
        } else {
            $erreur = true;
            $message[] = "Erreur de saisie du nom d'organisateur";
        }
    }
    if (isset($_POST["dateResearch"])) {
        if (preg_match($dateEventRegex, $_POST["dateResearch"])) {
            $data = $objEvent->selectEventsByDate($_POST["dateResearch"]);
        } else {
            $erreur = true;
            $message[] = "Erreur de saisie de la date";
        }
    }
    if (isset($_POST["tagResearch"])) {
        if (preg_match($tagRegex, $_POST["tagResearch"])) {
            $data = $objAssoc->selectEventByTagName($_POST["tagResearch"]);
        } else {
            $erreur = true;
            $message[] = "Erreur de saisie du tag";
        }
    }
}

if (!isset($data)) {
    if (!empty($_GET["tag"])) {
        $data = $objAssoc->selectEventByTagId(($_GET["tag"]));
    } else {
        $data = $objEvent->selectAllEventsOfWeek();
    }
}


$listeIdOrga = $objEvent->listOfMostActivIdOrga();

$topTenTags = $objAssoc->selectTenMoreFrequentTags();

$orga = [];
for ($i = 0; $i < 3; $i++) {
    $org = $objOrga->selectAllOrgaById($listeIdOrga[$i]->getIdOrga());
    $orga[] = $org;
}

afficherAgenda($data, $profil, $orga, $topTenTags, $erreur, $message);
