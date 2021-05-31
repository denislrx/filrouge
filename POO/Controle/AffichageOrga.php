<?php

include_once(__DIR__ . "/../Presentation/OrganisateurPresentation.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user" || $_SESSION["Profil"] == "admin") {
    $profil = $_SESSION["Profil"];
}

$obj = new OrganisateurService;
if (isset($_GET["id"])) {
    $data = $obj->selectAllOrgaById($_GET["id"]);
}

afficherOrga($data, $profil, $dataCarroussel);
