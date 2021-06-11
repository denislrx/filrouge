<?php

include_once(__DIR__ . "/../Presentation/OrganisateurPresentation.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/EvenementService.php");

session_start();
if (isset($_SESSION) || !empty($_SESSION) || $_SESSION["profil"] == "user" || $_SESSION["profil"] == "admin") {
    $profil = $_SESSION["profil"];
}

$obj = new OrganisateurService;
$event = new EvenementService;

if (isset($_GET["id"])) {
    $data = $obj->selectAllOrgaById($_GET["id"]);
    $dataCarroussel = $event->selectAllOrgaEventsOfWeek($_GET["id"]);
}

afficherOrga($data, $profil, $dataCarroussel);
