<?php

session_start();

include_once(__DIR__ . "/../Service/UtilisateurService.php");

$objUserService = new UtilisateurService;

$idOrga = $objUserService->getIdUserByIdOrga($_GET["id"]);
$objUserService->validate($idOrga);

header("location: PageAdmin.php");
