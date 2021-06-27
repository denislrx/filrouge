<?php

include_once(__DIR__ . "/../Service/EvenementService.php");


if (isset($_GET["id"])) {

    $objEventService = new EvenementService;
    $objTagService = new TagService;
    $objAssocService = new AssocTagEventService;

    try{ 
        $tabTag = $objTagService->selectTagByIdEvent($_GET["id"]);
    }catch(TagExceptionService $exc){
        echo $exc->getMessage();
    }
    $tagToErase = [];
    foreach ($tabTag as $tag) {
        $id = $tag->getIdTag();
        try{ 
            $i = $objAssocService->numberOfAssocForATag($id);
        }catch(AssocExceptionService $exc){
            echo $exc->getMessage();
        }
        if ($i == 1) {
            $tagToErase[] = $tag;
        }
    }
    try{ 
        $objAssocService->deleteAssocByIdEvent($_GET["id"]);
    }catch(AssocExceptionService $exc){
        echo $exc->getMessage();
    }

    if (!empty($tagToErase)) {
        foreach ($tagToErase as $tag) {
            try{ 
                $objTagService->deleteTag($tag->getIdTag());
            }catch(TagExceptionService $exc){
                echo $exc->getMessage();
            }
        }
    }
    try{ 
        $objEventService->deleteEvent($_GET["id"]);
    }catch(EventExceptionService $exc){
        echo $exc->getMessage();
    }
}

header("location:AfficherOrga.php");
