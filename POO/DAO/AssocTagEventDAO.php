<?php

include_once(__DIR__ . "/../Model/AssocTagEvent.php");
include_once(__DIR__ . "/../Model/Evenement.php");
include_once(__DIR__ . "/../Model/Tag.php");


class AssocTagEventDAO extends ConnexionDAO
{
    function insertAssoc($tag, $event)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("INSERT INTO assoctagevent(idTag, idEvent) VALUES(?,?);");
        $stmt->bind_param("ii", $tag, $event);
        $stmt->execute();
        $db->close();
    }

    function selectAssocById($id)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("SELECT * FROM assoctagevent WHERE idAssoc = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_array(MYSQLI_ASSOC);
        $objTag = new AssocTagEvent;
        $objTag->getIdAssocTagEvent($dataSet["idAssoc"]);
        $objTag->tag->getIdTag($dataSet["idTag"]);
        $objTag->evenement->getIdEvent($dataSet["idEvent"]);
        return $objTag;
    }

    function selectAssocByIdTag($idTag)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("SELECT * FROM tag WHERE nameTag = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        $tabTag = [];
        foreach ($dataSet as $set) {
            $objTag = new Tag;
            $objTag->setIdTag($dataSet["idTag"]);
            $objTag->setNomTag($dataSet["nomTag"]);
            $tabTag[] = $objTag;
        }
        return $tabTag;
    }
}
