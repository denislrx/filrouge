<?php

include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Presentation/PageAdminPresentation.php");

session_start();

$objUserService = new UtilisateurService;
$objEventService = new EvenementService;
$objOrgaService = new OrganisateurService;

try {
    $tabOrgaNoob = $objOrgaService->selectAllNoobOrga();
    $tabOrgaUser = $objOrgaService->selectAllUserOrga();
} catch (OrgaExceptionService $exc) {
    echo $exc->getMessage();
}
try {
    $tabLastPublishedEvent = $objEventService->selectLastPublishedEvent();
} catch (EventExceptionService $exc) {
    echo $exc->getMessage();
}

afficherAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent);
