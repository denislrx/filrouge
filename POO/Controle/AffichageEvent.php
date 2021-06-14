<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");

session_start();


$obj = new EvenementService;
$obj2 = new OrganisateurService;
$obj3 = new AssocTagEventService;

if (isset($_GET["id"])) {
    $data = $obj->selectAllEventById($_GET["id"]);
    $name = $obj2->selectNameByIdOrga($data->getIdOrga());
    $listTag = $obj3->selectTagListByEvent($_GET["id"]);
}

afficherEvent($data, $name, $listTag);
