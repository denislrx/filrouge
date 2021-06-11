<?php

include_once(__DIR__ . "/../Presentation/EvenementPresentation.php");
include_once(__DIR__ . "/../Service/EvenementService.php");
include_once(__DIR__ . "/../Service/TagService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");


session_start();

if (!($_SESSION["profil"] = "user" || $_SESSION["profil"] = "admin")) {
    header("location: connexion.php");
}

$objEventService = new EvenementService;
$objAssocService = new AssocTagEventService;
$objTagService = new TagService;
$objPost = new Evenement;


$isThereError = false;
if (!isset($_POST)) {
    $isThereError = true;
}

// if (isset($_GET["id"])) {
$id = $_GET["id"];
$data = $objEventService->selectAllEventById($id);
// }


$messages = [];
$tagRegex = "#^\#[\w_]{3,29}$#";
$nomEventRegex = "#^[0-9\p{L}\s'-]*$#";
$dateEventRegex = "#^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#";
$heureEventRegex = "#^[0-9]{2}:[0-9]{2}:[0-9]{2}$#";
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

    if (!isset($_FILES) || empty($_FILES)) {
        $isThereError = true;
        $messages[] = "Pas d'images à charger";
    }
    if (!isset($_POST["urlLien"]) || empty($_POST["urlLien"]) || !preg_match($urlLienRegex, $_POST["urlLien"])) {
        $isThereError = true;
        $messages[] = "Erreur de saisie de l'url";
    }
    // a faire rajouter un contrôle sur chaque tag

    // Recuperer les nouveaux tags, les traiter, faire un tableau NewTag
    $tabTag = [$_POST["tag1"], $_POST["tag2"], $_POST["tag3"], $_POST["tag4"]];

    $tabDefTag = [];
    foreach ($tabTag as $tag) {

        if (!empty($tag) && preg_match($tagRegex, $tag)) {
            $tabDefTag[] = $tag;
        }
    }


    if (!$isThereError) {

        if (empty($_FILES['image']['tmp_name'])) {
            $image = $data->getImage();
        } else {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        }

        $objPost->setNom($_POST["nom"]);
        $objPost->setDate($_POST["date"]);
        $objPost->setHeure($_POST["heure"]);
        $objPost->setLieu($_POST["lieu"]);
        $objPost->setDescription($_POST["description"]);
        $objPost->setImage($image);
        $objPost->setUrlLien($_POST["urlLien"]);
        $objPost->setIdOrga($_SESSION["idOrga"]);


        $objEventService->updateEvent($objPost, $id);


        // retrouver les relations existant dans Assoc           
        // conserver les objAssoc dans un tableau TabAssoc       
        $tabOldAssoc = $objAssocService->selectAssocByIdEvent($id);

        // recupérer l'idTag des Tag de la nouvelle liste
        // séparer en deux tableau les nouveaux tags : ceux qui existe déja et ceux qui faut créer
        $tabObjTagExist = [];
        $tabObjTagToCreate = [];
        if (!empty($tabDefTag)) {
            foreach ($tabDefTag as $newTag) {
                $objTag = $objTagService->selectTagByName($newTag);
                if ($objTag->getFalse() == TRUE) {
                    $tabObjTagExist[] = $objTag;
                } else {
                    $tabTagToCreate = $newTag;
                }
            }
        }

        //Comparer les anciennes relations avec Tags existants : 
        // Rassembler les relations qui ne sont pas dedans dans un tableau pour les effacer
        $tabAssocToErase = [];
        $tabTagToErase = [];
        if (!empty($tabOldAssoc)) {
            foreach ($tabOldAssoc as $oldAssoc) {
                $a = true;
                foreach ($tabObjTagExist as $objTagExist) {
                    if ($objTagExist->getidTag() === $oldAssoc->getTag()) {
                        $a = false;
                        $tabTagToErase[] = $objTagExist;
                    }
                }
                if ($a) {
                    $tabAssocToErase[] = $oldAssoc;
                }
            }
        }
        // effacer les Assoc qui ne sont pas dans NewTag         
        if (!empty($tabAssocToErase)) {
            foreach ($tabAssocToErase as $assoc) {
                $objAssocService->deleteAssoc($assoc->getIdAssocTagEvent());
            }
        }
        // var_dump($tabTagToErase);
        // effacer les Tags si ils n'ont plus d'assoc            
        if (!empty($tabTagToErase)) {
            foreach ($tabTagToErase as $tag) {
                $n = $objAssocService->numberOfAssocForATag($tag->getIdTag());
                if ($n == 0) {
                    $objTagService->deleteTag($tag->getIdTag());
                }
            }
        }

        // inserer les newTag et liens si n'existent pas         
        if (!empty($tabTagToCreate)) {
            foreach ($tabTagToCreate as $tag) {
                $idTag = $objTagService->insertTag($tag);
            }
            $assoc = new AssocTagEvent;
            $assoc->getEvenement($id);
            $assoc->getTag($idTag);
            $objAssocService->insertAssoc($assoc);
        }


        header("location: AffichageEvent.php?id=" . $id);
    }
}
$dataTag = $objAssocService->selectTagListByEvent($id);


afficherFormModifEvent($isThereError, $messages, $data, $dataTag);
