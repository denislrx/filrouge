<?php

include_once(__DIR__ . "/../DAO/TagDAO.php");

class TagService
{
    public function selectTagByName(string $name)
    {
        $tagDAO = new TagDAO;

        $tag = $tagDAO->selectTagByName($name);

        return $tag;
    }

    public function insertTag(string $nom)
    {
        $tagDAO = new TagDAO;

        $id = $tagDAO->insertTag($nom);

        return $id;
    }

    public function deleteTag(int $id)
    {
        $tagDAO = new TagDAO;

        $tagDAO->deleteTag($id);
    }

    function selectTagByIdEvent($id)
    {
        $tagDAO = new TagDAO;

        $tabTag = $tagDAO->selectTagByIdEvent($id);

        return $tabTag;
    }
}
