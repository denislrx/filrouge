<?php

include_once(__DIR__ . "/../Service/EvenementService.php");

if (isset($_GET["id"])) {

    $objService = new EvenementService;

    $objService->deleteEvent($_GET["id"]);
}

header("location:AfficherOrga.php");
