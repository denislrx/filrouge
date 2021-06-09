<?php

include_once(__DIR__ . "/../Service/EvenementService.php");


if (isset($_GET["id"])) {

    $objEventService = new EvenementService;
    $objTagService = new TagService;
    $objAssocService = new AssocTagEventService;


    $tabTag = $objTagService->selectTagByIdEvent($_GET["id"]);
    $tagToErase = [];
    foreach ($tabTag as $tag) {
        $id = $tag->getIdTag();
        $i = $objAssocService->numberOfAssocForATag($id);
        if ($i == 1) {
            $tagToErase[] = $tag;
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

header("location:AfficherOrga.php");
