<?php

include_once(__DIR__ . "/../Model/AssocTagEvent.php");
include_once(__DIR__ . "/../Model/Evenement.php");
include_once(__DIR__ . "/../Model/Tag.php");
include_once(__DIR__ . "/../Exception/TagExceptionDAO.php");


class AssocTagEventDAO extends ConnexionDAO
{
    function insertAssoc(AssocTagEvent $assoc)
    {
        try {
            $tag = $assoc->getTag();
            $event = $assoc->getEvenement();
            $db = parent::connexion();
            $stmt = $db->prepare("INSERT INTO assoctagevent(idTag, idEvent) VALUES(?,?);");
            $stmt->bind_param("ii", $tag, $event);
            $stmt->execute();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  insertAssoc() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
    }

    function selectAssocById($id)
    {
        try {
            $db = parent::connexion();
            $stmt = $db->prepare("SELECT * FROM assoctagevent WHERE idAssoc = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectAssocById() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
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
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT e.* FROM evenement AS e INNER JOIN assoctagevent AS a ON e.idEvent = a.idEvent INNER JOIN tag as t ON t.idTag = a.idTag WHERE t.idTag = ? ORDER BY e.date");
            $stmt->bind_param("i", $idTag);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectEventByIdTag() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
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
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT t.* FROM tag AS t INNER JOIN assoctagevent AS a ON t.idTag = a.idTag INNER JOIN evenement as e ON e.idEvent = a.idEvent WHERE e.IdEvent = ?");
            $stmt->bind_param("i", $idEvent);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectTagListByEvent() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
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
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("SELECT * FROM assoctagevent WHERE idEvent = ?");
            $stmt->bind_param("i", $idEvent);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectAssocByIdEvent() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
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
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("DELETE FROM  assoctagevent WHERE idAssoc = ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  deleteAssoc() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
    }

    function numberOfAssocForATag($idTag)
    {
        try {
            $db = parent::connexion();
            $stmt = $db->prepare("SELECT COUNT(*) FROM assoctagevent WHERE idTag = ?");
            $stmt->bind_param("i", $idTag);
            $stmt->execute();
            $result = $stmt->get_result();
            $nbrAssoc = $result->fetch_array(MYSQLI_NUM);
            $result->free();
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  nummberOfAssocForATag() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
        return $nbrAssoc[0];
    }

    function deleteAssocByIdEvent($id)
    {
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("DELETE FROM  assoctagevent WHERE idEvent = ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  deleteAssocByIdEvent() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
    }

    function selectTenMoreFrequentTags()
    {
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare(" SELECT t.* FROM assoctagevent AS a INNER JOIN tag AS t WHERE a.idTag = t.idTag GROUP BY t.idTag ORDER BY COUNT(t.idTag) DESC LIMIT 10");
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectTenMoreFrequentTags() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
        $tabObjTag = [];
        foreach ($dataSet as $data) {
            $objTag = new Tag;
            $objTag->setIdTag($data["idTag"]);
            $objTag->setNomTag($data["nomTag"]);
            $tabObjTag[] = $objTag;
        }

        return $tabObjTag;
    }

    function selectEventByTagName($name)
    {
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare(" SELECT e.* FROM tag AS t INNER JOIN assoctagevent AS a ON t.idTag = a.idTag INNER JOIN evenement as e ON e.idEvent = a.idEvent WHERE t.nomTag = ? ORDER BY date");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectEventByTagName() ne marche pas";
            throw new AssocExceptionDAO($message, $exc->getCode);
        }
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
}
