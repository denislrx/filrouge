<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/TagService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");

session_start();
if (!isset($_SESSION)) {
    header("location: connexion.php");
}

$objTag = new TagService;
$objAssoc = new AssocTagEventService;

$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

$messages = [];

$tagRegex = "#^\#[\w_]{3,29}$#";
$nomEventRegex = "#^[0-9\p{L}\s'-]*$#";
$dateEventRegex = "#^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#";
$heureEventRegex = "#^[0-9]{2}:[0-9]{2}$#";
$lieuEventRegex = "#^[0-9\p{L}\s'-]*$#";
$descriptionRegex = "#^[0-9\p{L}\s'-]*$#";
$urlLienRegex = "#^(http\:\/\/[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$#";


if (!empty($_POST)) {

    if (!isset($_POST["nom"]) || empty($_POST["nom"]) || !preg_match($nomEventRegex, $_POST["nom"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du nom";
    }
    if (!isset($_POST["date"]) || empty($_POST["date"]) || !preg_match($dateEventRegex, $_POST["date"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la date";
    }
    if (!isset($_POST["heure"]) || empty($_POST["heure"]) || !preg_match($heureEventRegex, $_POST["heure"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du l'heure";
    }
    if (!isset($_POST["lieu"]) || empty($_POST["lieu"]) || !preg_match($lieuEventRegex, $_POST["lieu"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie du lieu";
    }

    if (!isset($_POST["description"]) || empty($_POST["description"]) || !preg_match($descriptionRegex, $_POST["description"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de la description";
    }

    if (!isset($_POST["urlLien"]) || empty($_POST["urlLien"]) || !preg_match($urlLienRegex, $_POST["urlLien"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'url";
    }

    if (!isset($_FILES['image']['tmp_name']) || empty($_FILES['image']['tmp_name'])) {
        $isThereError = true;
        $messages[] = "Pas d'images à charger";
    }

    $tabTag = [$_POST["tag1"], $_POST["tag2"], $_POST["tag3"], $_POST["tag4"]];

    // var_dump($tabTag);

    $tabDefTag = [];
    foreach ($tabTag as $tag) {
        if (!empty($tag) && preg_match($tagRegex, $tag)) {
            $tabDefTag[] = $tag;
        }
    }

    // var_dump($tabDefTag);

    if (!$isThereError) {
        $objService = new EvenementService;
        $objPost = new Evenement;
        $objPost->setNom($_POST["nom"]);
        $objPost->setDate($_POST["date"]);
        $objPost->setHeure($_POST["heure"]);
        $objPost->setLieu($_POST["lieu"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setImage(file_get_contents($_FILES['image']['tmp_name']));
        $objPost->setUrlLien($_POST["urlLien"]);
        $objPost->setIdOrga($_SESSION["idOrga"]);

        $idEvent = $objService->insertEvent($objPost);

        // var_dump($idEvent);
        if (!empty($tabDefTag)) {
            foreach ($tabDefTag as $tag) {
                $t = $objTag->selectTagByName($tag);
                // var_dump($t);
                if ($t->getFalse() == false) {
                    $idTag = $objTag->insertTag($tag);
                } else {
                    $idTag = $t->getIdTag();
                }
                // var_dump($idTag);
                $assoc = new AssocTagEvent;
                $assoc->setEvenement($idEvent);
                $assoc->setTag($idTag);
                // var_dump($assoc);
                $objAssoc->insertAssoc($assoc);
            }
        }




        header("location: AffichageEvent.php?id=" . $idEvent);
    }
}
afficherFormInsertEvent($isThereError, $messages);
