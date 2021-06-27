<?php

session_start();

include_once(__DIR__ . "/../Service/UtilisateurService.php");

$objUserService = new UtilisateurService;

try {
    $idOrga = $objUserService->getIdUserByIdOrga($_GET["id"]);
    $objUserService->validate($idOrga);
} catch (OrgaExceptionService $exc) {
    echo $exc->getMessage();
}

header("location: PageAdmin.php");
