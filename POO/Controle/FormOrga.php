<?php

include_once(__DIR__ . "/../Presentation/OrganisateurPresentation.php");
include_once(__DIR__ . "/../Service/OrganisateurService.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}

$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

// faire les regex
$messages = [];
$nomRegex = "";
$adresseRegex = "";
$codePostalRegex = "";
$villeRegex = "";
$descriptionRegex = "";
$emailRegex = "";
$telephoneRegex = "";
$adresseTwitterRegex = "";
$adresseInstaRegex = "";
$adresseFBRegex = "";
$adresseSiteRegex = "";

if (!empty($_POST)) {

    if (!isset($_POST["nom"]) || empty($_POST["nom"]) || !preg_match($syntaxNom, $_POST["nomRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }
    if (!isset($_POST["adresse"]) || empty($_POST["adresse"]) || !preg_match($syntaxNom, $_POST["adresseRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse";
    }
    if (!isset($_POST["codePostal"]) || empty($_POST["codePostal"]) || !preg_match($syntaxNom, $_POST["codePostal"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du code postal";
    }
    if (!isset($_POST["ville"]) || empty($_POST["ville"]) || !preg_match($syntaxNom, $_POST["villeRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la ville";
    }
    if (!isset($_POST["description"]) || empty($_POST["description"]) || !preg_match($syntaxNom, $_POST["descriptionRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie dans la description";
    }
    if (!isset($_POST["email"]) || empty($_POST["email"]) || !preg_match($syntaxNom, $_POST["emailRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'e-mail";
    }
    if (!isset($_POST["telephone"]) || empty($_POST["telephone"]) || !preg_match($syntaxNom, $_POST["telephone"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du numéro de téléphone";
    }
    if (!isset($_POST["adresseTwitter"]) || empty($_POST["adresseTwitter"]) || !preg_match($syntaxNom, $_POST["adresseTwitterRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Twitter";
    }
    if (!isset($_POST["adresseInsta"]) || empty($_POST["adresseInsta"]) || !preg_match($syntaxNom, $_POST["adresseTwitterInsta"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Instagram";
    }
    if (!isset($_POST["adresseFB"]) || empty($_POST["adresseFB"]) || !preg_match($syntaxNom, $_POST["adresseFBRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse Facebook";
    }
    if (!isset($_POST["adresseSite"]) || empty($_POST["adresseSite"]) || !preg_match($syntaxNom, $_POST["$adresseSiteRegex"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'adresse du site";
    }

    if (!$isThereError) {
        $objService = new OrganisateurService;
        $objPost = new Organisateur;
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
        $objPost->setAdresseSite($_POST["adresseSite"]);
        $objPost->setImage($_POST["image"]);

        $objService->insertOrga($objPost);

        // header vers page Organisateur créé (avec Get IdUser ?)
        header("location: AffichageOrga.php");
    }
    AfficherFormOrga($isThereError, $messages);
}
