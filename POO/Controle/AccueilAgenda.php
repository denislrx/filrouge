<?php

include_once(__DIR__ . "/../Presentation/AgendaPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

$profil = "";
session_start();

if (isset($_SESSION["Profil"])) {
    $profil = $_SESSION["Profil"];
}

var_dump($profil);
$objOrga = new OrganisateurService;
$objEvent = new EvenementService;

$data = $objEvent->selectAllEventsOfWeek();


afficherAgenda($data, $profil);
