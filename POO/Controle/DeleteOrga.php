
<?php

include_once(__DIR__ . "/../Service/OrganisateurService.php");
include_once(__DIR__ . "/../Service/EvenmenentService.php");
include_once(__DIR__ . "/../Service/AssocTagEventService.php");
include_once(__DIR__ . "/../Service/TagService.php");


if (isset($_GET["id"])) {

    $objService = new OrganisateurService;
    $objEventService = new EvenementService;
    $objTagService = new TagService;
    $objAssocService = new AssocTagEventService;

    $tabEvent = $objEventService->selectEventByIdOrga($_GET["id"]);

    if (!empty($tabEvent)) {
        foreach ($tabEvent as $event) {
            $tabTag = $objTagService->selectTagByIdEvent($_GET["id"]);
            $tagToErase = [];
            if (!empty($TabTag)) {
                foreach ($tabTag as $tag) {
                    $id = $tag->getIdTag();
                    $i = $objAssocService->numberOfAssocForATag($id);
                    if ($i == 1) {
                        $tagToErase[] = $tag;
                    }
                }
            }

            $objAssocService->deleteAssocByIdEvent($_GET["id"]);

            if (!empty($tagToErase)) {
                foreach ($tagToErase as $tag) {
                    $objTagService->deleteTag($tag->getIdTag());
                }
            }

            $objEventService->deleteEvent($_GET["id"]);
        }
    }
}

$objService->deleteOrga($_GET["id"]);


header("location:emp.php");
