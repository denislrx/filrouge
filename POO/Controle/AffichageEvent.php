<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

// session_start();
// if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user" || $_SESSION["Profil"] == "admin") {
//     $profil = $_SESSION["Profil"];
// }

$obj = new EvenementService;
$obj2 = new OrganisateurService;

// if (isset($_GET["id"])) {
$data = $obj->selectAllEventById($_GET["id"]);
$name = $obj2->selectNameByIdOrga($data->getIdOrga());
// }

afficherEvent($data, $profil, $name);
