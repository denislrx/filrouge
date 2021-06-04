<?php

include_once("Model/Tag.php");

class TagDAO extends ConnexionDAO
{
    function insertTag($tag)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("INSERT INTO tag (nomTag) VALUES(?);");
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $db->close();
    }

    function selectTagById($id)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("SELECT * FROM tag WHERE idTag = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_array(MYSQLI_ASSOC);
        $db->close();
        $objTag = new Tag;
        $objTag->setIdTag($dataSet["idTag"]);
        $objTag->setNomTag($dataSet["nomTag"]);
        return $objTag;
    }

    function selectTagByName($name)
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
