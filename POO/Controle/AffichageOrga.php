<?php

include_once(__DIR__ . "/../Presentation/OrganisateurPresentation.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/EvenementService.php");

session_start();

$obj = new OrganisateurService;
$event = new EvenementService;

if (isset($_GET["id"])) {
    try {
        $data = $obj->selectAllOrgaById($_GET["id"]);
    } catch (OrgaExceptionService $exc) {
        echo $exc->getMessage();
    }
    try {
        $dataCarroussel = $event->selectAllIncomingEventsOfAnEvent($_GET["id"]);
    } catch (EventExceptionService $exc) {
        echo $exc->getMessage();
    }
}

afficherOrga($data, $dataCarroussel);
