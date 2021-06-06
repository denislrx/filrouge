<?php

include_once(__DIR__ . "/../Presentation/AgendaPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");

$profil = "";
session_start();

if (isset($_SESSION["Profil"])) {
    $profil = $_SESSION;
}

// if (!isset($_SESSION["idOrga"])) {
//     header("location:FormOrgaInsert.php");
// }

$objOrga = new OrganisateurService;
$objEvent = new EvenementService;
$objAssoc = new AssocTagEventService;


if (!empty($_GET["tag"])) {
    $data = $objAssoc->selectEventByTagId(($_GET["tag"]));
} else {
    $data = $objEvent->selectAllEventsOfWeek();
}
$listeIdOrga = $objEvent->listOfMostActivIdOrga();
$orga = [];
for ($i = 0; $i < 3; $i++) {
    $org = $objOrga->selectAllOrgaById($listeIdOrga[$i]->getIdOrga());
    $orga[] = $org;
}

afficherAgenda($data, $profil, $orga);
