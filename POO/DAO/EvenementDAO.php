<?php

include_once(__DIR__ . "Model/Evenement.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class EvenementDAO extends ConnexionDAO
{
    public function insertEvent(Evenement $obj): void
    {
        $db = parent::connexion();
        $date = $obj->getDate();
        $heure = $obj->getHeure();
        $nom = $obj->getNom();
        $lieu = $obj->getLieu();
        $description = $obj->getDescription();
        $image = $obj->getImage();
        $urlLien = $obj->getUrlLien();
        $idOrga = $obj->getIdOrga();
        $stmt = $db->prepare("INSERT INTO evenement(idEvent, date, heure, nom, lieu, description, image, urlLien, idOrga)
        VALUES(?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param(
            "isssssssi",
            $idEvent,
            $date,
            $heure,
            $nom,
            $lieu,
            $description,
            $image,
            $urlLien,
            $idOrga
        );
        $stmt->execute();
        $db->close();
    }

    function updateEvent(Evenement $objInsert, int $id)
    {
        $bdd = $this->connexion();
        $date = $objInsert->getDate();
        $heure = $objInsert->getHeure();
        $nom = $objInsert->getNom();
        $lieu = $objInsert->getLieu();
        $description = $objInsert->getDescription();
        $image = $objInsert->getImage();
        $urlLien = $objInsert->getUrlLien();
        $stmt = $bdd->prepare("UPDATE evenement SET
        date =?, heure=?, nom=?, lieu=?, description=?, image=?, urlLien=?,WHERE idEvent = ?;");
        $stmt->bind_param(
            "sssssssi",
            $date,
            $heure,
            $nom,
            $lieu,
            $description,
            $image,
            $urlLien,
            $id
        );
    }

    function deleteEvent($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM evenement WHERE idEvent = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }

    function selectAllEventById(int $id): Evenement
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM evenement WHERE idEvent = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $objEventById = new Evenement;
        $objEventById->setIdEvent($data["idEvent"]);
        $objEventById->setDate($data["date"]);
        $objEventById->setHeure($data["heure"]);
        $objEventById->setNom($data["nom"]);
        $objEventById->setLieu($data["lieu"]);
        $objEventById->setDescription($data["description"]);
        $objEventById->setImage($data["image"]);
        $objEventById->setUrlLien($data["urlLien"]);


        return $objEventById;
    }
}
