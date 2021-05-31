<?php

include_once(__DIR__ . "/../Presentation/OrganisateurPresentation.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION)) {
    header("location: connexion.php");
}

$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

$obj = new OrganisateurService;
$objPost = new Organisateur;

$messages = [];
$nomRegex = "#^[\p{L}\s'-]*$#";
$adresseRegex = "#^[0-9\p{L}\s'-]*$#";
$codePostalRegex = "#[0-9]{5}#";
$villeRegex = "#^[A-Z][\p{L}\s'-]*$#";
$descriptionRegex = "#^[\p{L}\s'-]*$#";
$emailRegex = "#^[\w\.]+@([\w\-]+\.)+[\w\-]{2,4}$#";
$telephoneRegex = "#[0-9]*#";
$adresseTwitterRegex = "#^@?(\w){1,15}$#";
$adresseInstaRegex = "#(https?)?:?\/?\/?(www)?instagram\.com/[\w]*#";
$adresseFBRegex = "#(?:(?:http|https):\/\/)?(?:www.|m.)?facebook.com\/(?!home.php)(?:(?:\w)*\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\.-]+)#";
$adresseSiteRegex = "#^(http\:\/\/[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$#";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $data = $obj->selectAllOrgaById($_GET["id"]);
}

if (!empty($_POST)) {

    if (!isset($_POST["nom"]) || empty($_POST["nom"]) || !preg_match($nomRegex, $_POST["nom"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }
    if (!isset($_POST["adresse"]) || (!empty($_POST["adresse"]) && !preg_match($adresseRegex, $_POST["adresse"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse";
    }

    if (!isset($_POST["codePostal"]) || (!empty($_POST["codePostal"]) && !preg_match($codePostalRegex, $_POST["codePostal"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du code postal";
    }

    if (!isset($_POST["ville"]) || empty($_POST["ville"]) || !preg_match($villeRegex, $_POST["ville"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la ville";
    }
    if (!isset($_POST["description"]) || empty($_POST["description"]) || !preg_match($descriptionRegex, $_POST["description"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans la description";
    }
    if (!isset($_POST["email"]) || empty($_POST["email"]) || !preg_match($emailRegex, $_POST["email"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'e-mail";
    }
    if (!isset($_POST["telephone"]) || (!empty($_POST["telephone"]) && !preg_match($telephoneRegex, $_POST["telephone"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du numéro de téléphone";
    }

    if (!isset($_POST["adresseTwitter"]) || (!empty($_POST["codePostal"]) && !preg_match($adresseTwitterRegex, $_POST["codePostal"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Twitter";
    }

    if (!isset($_POST["adresseInsta"]) || (!empty($_POST["adresseInsta"]) && !preg_match($adresseInstaRegex, $_POST["adresseInsta"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Instagram";
    }

    if (!isset($_POST["adresseFB"]) || (!empty($_POST["adresseFB"]) && !preg_match($adresseFBRegex, $_POST["adresseFB"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Facebook";
    }

    if (!isset($_POST["adresseSite"]) || (!empty($_POST["adresseSite"]) && !preg_match($adresseSiteRegex, $_POST["adresseSite"]))) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse du site";
    }

    if (!$isThereError) {

        if (empty($_FILES['image']['tmp_name'])) {
            $image = $data->getImage();
        } else {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        }
        // var_dump($_POST);
        $objPost->setNom($_POST["nom"]);
        $objPost->setAdresse($_POST["adresse"]);
        $objPost->setCodePostal($_POST["codePostal"]);
        $objPost->setVille($_POST["ville"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setEmail($_POST["email"]);
        $objPost->setTelephone($_POST["telephone"]);
        $objPost->setAdresseTwitter($_POST["adresseTwitter"]);
        $objPost->setAdresseInsta($_POST["adresseInsta"]);
        $objPost->setAdresseFB($_POST["adresseFB"]);
        $objPost->setAdresseSite($_POST["adresseSite"]);
        $objPost->setImage($image);
        $objPost->setIdUser($_SESSION["idUser"]);

        $obj->updateOrga($objPost, $id);

        // header("location: AffichageOrga.php?id=$id");
    }
}
AfficherModifFormOrga($isThereError, $messages, $data);
