<?php

include_once(__DIR__ . "/../Model/Evenement.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class EvenementDAO extends ConnexionDAO
{
    public function insertEvent(Evenement $obj): int
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
        $stmt = $db->prepare("INSERT INTO evenement(idEvent, date, heure, nom, Lieu, description, image, urlLien, idOrga)
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
        $id = $stmt->insert_id;
        $db->close();
        return $id;
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
        date =?, heure=?, nom=?, Lieu=?, description=?, image=?, urlLien=? WHERE idEvent = ?");
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
        $stmt->execute();
        $bdd->close();
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
        $objEventById->setLieu($data["Lieu"]);
        $objEventById->setDescription($data["description"]);
        $objEventById->setImage($data["image"]);
        $objEventById->setUrlLien($data["urlLien"]);
        $objEventById->setIdOrga($data["idOrga"]);


        return $objEventById;
    }


    function selectAllOrgaEventsOfWeek(int $id): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM evenement WHERE idOrga = ? AND date BETWEEN CURDATE() AND ADDDATE(CURDATE(), INTERVAL 100 DAY)");
        $stmt->bind_param("i", $id);
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
            $tabObjEvent[] = $objEvent;
        }

        return $tabObjEvent;
    }
    function selectAllEventsOfWeek(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM evenement WHERE date BETWEEN CURDATE() AND ADDDATE(CURDATE(), INTERVAL 7 DAY) ORDER BY date");
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
        // var_dump(count($tabObjEvent));
        return $tabObjEvent;
    }
    function listOfMostActivIdOrga()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT idOrga FROM evenement WHERE date >= CURDATE() GROUP BY idOrga ORDER BY COUNT(idOrga) desc");
        $stmt->execute();
        $result = $stmt->get_result();
        $dataSet = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabObjEvent = [];
        foreach ($dataSet as $data) {
            $objEvent = new Evenement;
            $objEvent->setIdOrga($data["idOrga"]);
            $tabObjEvent[] = $objEvent;
        }
        // var_dump(count($tabObjEvent));
        return $tabObjEvent;
    }

    function selectEventByIdOrga($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM evenement WHERE idOrga = ?");
        $stmt->bind_param("i", $id);
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
            $tabObjEvent[] = $objEvent;
        }

        return $tabObjEvent;
    }

    public function selectLastPublishedEvent()
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM evenement WHERE date > CURDATE() ORDER BY datePubli");
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
        // var_dump(count($tabObjEvent));
        return $tabObjEvent;
    }
}
