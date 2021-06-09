<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["profil"] == "user" || $_SESSION["profil"] == "admin") {
    $profil = $_SESSION["profil"];
}

$obj = new EvenementService;
$obj2 = new OrganisateurService;
$obj3 = new AssocTagEventService;

if (isset($_GET["id"])) {
    $data = $obj->selectAllEventById($_GET["id"]);
    $name = $obj2->selectNameByIdOrga($data->getIdOrga());
    $listTag = $obj3->selectTagListByEvent($_GET["id"]);
}

afficherEvent($data, $profil, $name, $listTag);
