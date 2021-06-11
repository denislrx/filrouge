<?php

include_once(__DIR__ . "/../Model/AssocTagEvent.php");
include_once(__DIR__ . "/../Model/Evenement.php");
include_once(__DIR__ . "/../Model/Tag.php");


class AssocTagEventDAO extends ConnexionDAO
{
    function insertAssoc(AssocTagEvent $assoc)
    {
        $tag = $assoc->getTag();
        $event = $assoc->getEvenement();
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

    function selectEventByTagId(int $idTag): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT e.* FROM evenement AS e INNER JOIN assoctagevent AS a ON e.idEvent = a.idEvent INNER JOIN tag as t ON t.idTag = a.idTag WHERE t.idTag = ? ORDER BY e.date");
        $stmt->bind_param("i", $idTag);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabObjEvent = [];
        foreach ($dataSet as $data) {
            $objEvent = new Evenement;
            $objEvent->setIdEvent($data["idEvent"]);
            $objEvent->setDate($data["date"]);
            $objEvent->setHeure($data["heure"]);
            $objEvent->setNom($data["nom"]);
            $objEvent->setLieu($data["Lieu"]);
            $objEvent->setDescription($data["description"]);
            $objEvent->setImage($data["image"]);
            $objEvent->setUrlLien($data["urlLien"]);
            $objEvent->setIdOrga($data["idOrga"]);
            $tabObjEvent[] = $objEvent;
        }

        return $tabObjEvent;
    }

    function selectTagListByEvent(int $idEvent): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT t.* FROM tag AS t INNER JOIN assoctagevent AS a ON t.idTag = a.idTag INNER JOIN evenement as e ON e.idEvent = a.idEvent WHERE e.IdEvent = ?");
        $stmt->bind_param("i", $idEvent);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabObjTag = [];
        foreach ($dataSet as $data) {
            $objTag = new Tag;
            $objTag->setIdTag($data["idTag"]);
            $objTag->setNomTag($data["nomTag"]);

            $tabObjTag[] = $objTag;
        }


        return $tabObjTag;
    }

    function selectAssocByIdEvent($idEvent): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM assoctagevent WHERE idEvent = ?");
        $stmt->bind_param("i", $idEvent);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabObjAssoc = [];
        foreach ($dataSet as $data) {
            $objAssoc = new AssocTagEvent;
            $objAssoc->setIdAssocTagEvent($data["idAssoc"]);
            $objAssoc->setTag($data["idTag"]);
            $objAssoc->setEvenement($data["idEvent"]);

            $tabObjAssoc[] = $objAssoc;
        }

        return $tabObjAssoc;
    }

    function deleteAssoc($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM  assoctagevent WHERE idAssoc = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }

    function numberOfAssocForATag($idTag)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("SELECT COUNT(*) FROM assoctagevent WHERE idTag = ?");
        $stmt->bind_param("i", $idTag);
        $stmt->execute();
        $result = $stmt->get_result();
        $nbrAssoc = $result->fetch_array(MYSQLI_NUM);
        var_dump($nbrAssoc);
        return $nbrAssoc[0];
    }

    function deleteAssocByIdEvent($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM  assoctagevent WHERE idEvent = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }
}
