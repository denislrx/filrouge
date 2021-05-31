<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user" || $_SESSION["Profil"] == "admin") {
    $profil = $_SESSION["Profil"];
}

$obj = new EvenementService;
if (isset($_GET["id"])) {
    $data = $obj->selectAllEventById($_GET["id"]);
}

afficherEvent($data, $profil);
