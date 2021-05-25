
<?php

include_once(__DIR__ . "/../Service/OrganisateurService.php");

if (isset($_GET["id"])) {

    $objService = new OrganisateurService;

    $objService->deleteOrga($_GET["id"]);
}

header("location:emp.php");
