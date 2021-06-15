<?php

include_once(__DIR__ . "/../DAO/TagDAO.php");

class TagService
{
    private $tagDAO;

    public function __construct()
    {
        $this->tagDAO = new TagDAO;
    }

    public function selectTagByName(string $name)
    {

        try {
            $tag = $this->tagDAO->selectTagByName($name);
        } catch (TagExceptionDAO $exc) {
            throw new TagExceptionService($exc->getMessage());
        }

        return $tag;
    }

    public function insertTag(string $nom)
    {

        try {
            $id = $this->tagDAO->insertTag($nom);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $id;
    }

    public function deleteTag(int $id)
    {
        try {
            $this->tagDAO->deleteTag($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }
    }

    function selectTagByIdEvent($id)
    {

        try {
            $tabTag = $this->tagDAO->selectTagByIdEvent($id);
        } catch (AssocExceptionDAO $exc) {
            throw new AssocExceptionService($exc->getMessage());
        }

        return $tabTag;
    }
}
