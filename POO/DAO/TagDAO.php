<?php

include_once(__DIR__ . "/../Model/Tag.php");

class TagDAO extends ConnexionDAO
{
    function insertTag(string $tag)
    {
        $db = parent::connexion();
        $stmt = $db->prepare("INSERT INTO tag (nomTag) VALUES(?);");
        $stmt->bind_param("s", $tag);
        $stmt->execute();
        $id = $stmt->insert_id;
        $db->close();
        return $id;
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
        $stmt = $db->prepare("SELECT * FROM tag WHERE nomTag = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $tag = $result->fetch_array(MYSQLI_ASSOC);
        $objTag = new Tag;
        if ($tag == NULL) {
            $objTag->setFalse(false);
        } else {
            $objTag->setNomTag($tag["nomTag"]);
            $objTag->setIdTag($tag["idTag"]);
            $objTag->setFalse(true);
        }
        $db->close();

        return $objTag;
    }
}
