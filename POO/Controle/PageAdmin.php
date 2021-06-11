<?php

include_once(__DIR__ . "/../Service/UtilisateurService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Presentation/PageAdminPresentation.php");

session_start();

$objUserService = new UtilisateurService;
$objEventService = new EvenementService;
$objOrgaService = new OrganisateurService;

$tabOrgaNoob = $objOrgaService->selectAllNoobOrga();
$tabOrgaUser = $objOrgaService->selectAllUserOrga();
$tabLastPublishedEvent = $objEventService->selectLastPublishedEvent();

afficherAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent);
