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
    try {
        $data = $obj->selectAllEventById($_GET["id"]);
    } catch (EventExceptionService $exc) {
        echo $exc->getMessage();
    }
    try {
        $name = $obj2->selectNameByIdOrga($data->getIdOrga());
    } catch (OrgaExceptionService $exc) {
        echo $exc->getMessage();
    }
    try {
        $listTag = $obj3->selectTagListByEvent($_GET["id"]);
    } catch (TagExceptionService $exc) {
        echo $exc->getMessage();
    }
}

afficherEvent($data, $name, $listTag);
