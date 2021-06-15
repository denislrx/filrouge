<?php

include_once(__DIR__ . "/../DAO/OrganisateurDAO.php");
include_once(__DIR__ . "/../Exception/OrgaExceptionService.php");

class OrganisateurService
{
    private $organisateurDAO;

    public function __construct()
    {
        $this->organisateurDAO = new OrganisateurDAO;
    }

    public function selectAllOrgaById(int $id): Organisateur
    {
        try {
            $organisateur = $this->organisateurDAO->selectAllOrgaById($id);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }

        return $organisateur;
    }

    public function selectAllOrgaByIdUser(int $id): ?Organisateur
    {
        try {
            $organisateur = $this->organisateurDAO->selectAllOrgaByIdUser($id);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }
        return $organisateur;
    }

    public function updateOrga(Organisateur $objInsert, int $id)
    {
        try {
            $this->organisateurDAO->updateOrga($objInsert, $id);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }
    }

    public function insertOrga(Organisateur $objInsert)
    {
        try {
            $id = $this->organisateurDAO->insertOrga($objInsert);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }
        return $id;
    }

    public function deleteOrga(int $id)
    {
        try {
            $this->organisateurDAO->deleteOrga($id);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }
    }

    public function selectNameByIdOrga(int $id): Organisateur
    {
        try {
            $organisateur = $this->organisateurDAO->selectNameByIdOrga($id);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }

        return $organisateur;
    }

    public function selectAllNoobOrga(): array
    {
        try {
            $organisateur = $this->organisateurDAO->selectAllNoobOrga();
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }

        return $organisateur;
    }

    public function selectAllUserOrga(): array
    {
        try {
            $organisateur = $this->organisateurDAO->selectAllUserOrga();
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }


        return $organisateur;
    }

    public function selectIdOrgaByName(string $name): int
    {
        try {
            $idOrga = $this->organisateurDAO->selectIdOrgaByName($name);
        } catch (OrgaExceptionDAO $exc) {
            throw new OrgaExceptionService($exc->getMessage());
        }

        return $idOrga;
    }
}
