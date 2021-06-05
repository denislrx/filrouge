<?php

include_once(__DIR__ . "/../Model/AssocTagEvent.php");
include_once(__DIR__ . "/../Model/Evenement.php");
include_once(__DIR__ . "/../Model/Tag.php");


class AssocTagEventDAO extends ConnexionDAO
{
    function insertAssoc(AssocTagEvent $assoc)
    {
        $tag = $assoc->getEvenement();
        $event = $assoc->getTag();
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

    function selectEventBtTagName($name)
    {
        //SELECT e.* FROM evenement AS e INNER JOIN asssoctagevent AS a ON e.idEvent = a.idEvent INNER JOIN tag as t ON t.idTag = a.idTag WHERE t.nom Tag = ? 
    }
}
