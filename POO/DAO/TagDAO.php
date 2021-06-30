<?php

include_once(__DIR__ . "/../Model/Tag.php");
include_once(__DIR__ . "/../Exception/TagExceptionDAO.php");


class TagDAO extends ConnexionDAO
{
    function insertTag(string $tag)
    {
        try {
            $db = parent::connexion();
            $stmt = $db->prepare("INSERT INTO tag (nomTag) VALUES(?);");
            $stmt->bind_param("s", $tag);
            $stmt->execute();
            $id = $stmt->insert_id;
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  insertTag() ne marche pas";
            throw new TagExceptionDAO($message, $exc->getCode);
        }
        return $id;
    }


    function selectTagById($id)
    {
        try {
            $db = parent::connexion();
            $stmt = $db->prepare("SELECT * FROM tag WHERE idTag = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_array(MYSQLI_ASSOC);
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectTagById() ne marche pas";
            throw new TagExceptionDAO($message, $exc->getCode);
        }
        $objTag = new Tag;
        $objTag->setIdTag($dataSet["idTag"]);
        $objTag->setNomTag($dataSet["nomTag"]);
        return $objTag;
    }

    function selectTagByName($name)
    {
        try {
            $db = parent::connexion();

            $stmt = $db->prepare("SELECT * FROM tag WHERE nomTag = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $db->close();
            $result = $stmt->get_result();
            $tag = $result->fetch_array(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  selectTagByName() ne marche pas";
            throw new TagExceptionDAO($message, $exc->getCode);
        }
        $objTag = new Tag;
        if ($tag == NULL) {
            $objTag->setFalse(false);
        } else {
            $objTag->setNomTag($tag["nomTag"]);
            $objTag->setIdTag($tag["idTag"]);
            $objTag->setFalse(true);
        }

        return $objTag;
    }



    function deleteTag($id)
    {
        try {
            $bdd = $this->connexion();
            $stmt = $bdd->prepare("DELETE FROM  Tag WHERE idTag = ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $bdd->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  deleteTag() ne marche pas";
            throw new TagExceptionDAO($message, $exc->getCode);
        }
    }

    function selectTagByIdEvent($id)
    {
        try {
            $db = parent::connexion();
            $stmt = $db->prepare("SELECT * FROM tag AS t INNER JOIN assoctagevent AS a ON t.idTag = a.idTag WHERE a.idEvent = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $dataSet = $result->fetch_all(MYSQLI_ASSOC);
            $db->close();
        } catch (mysqli_sql_exception $exc) {
            $message = "La fonction  slectTagByIdEvent() ne marche pas";
            throw new TagExceptionDAO($message, $exc->getCode);
        }
        $tabObjTag = [];
        foreach ($dataSet as $data) {
            $objTag = new Tag;
            $objTag->setIdTag($data["idTag"]);
            $objTag->setNomTag($data["nomTag"]);
            $$tabObjTag[] = $objTag;
        }
        return $tabObjTag;
    }
}
