<?php

include_once(__DIR__ . "/../Model/Organisateur.php");
include_once(__DIR__ . "/ConnexionDAO.php");

class OrganisateurDAO extends ConnexionDAO
{

    function selectAllOrgaById(int $id): Organisateur
    {

        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM organisateur WHERE idOrga = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $objOrgaById = new Organisateur;
        $objOrgaById->setIdOrga($data["idOrga"]);
        $objOrgaById->setNom($data["nom"]);
        $objOrgaById->setAdresse($data["adresse"]);
        $objOrgaById->setCodePostal($data["codePostal"]);
        $objOrgaById->setVille($data["ville"]);
        $objOrgaById->setDescription($data["description"]);
        $objOrgaById->setEmail($data["email"]);
        $objOrgaById->setTelephone($data["telephone"]);
        $objOrgaById->setAdresseTwitter($data["adresseTwitter"]);
        $objOrgaById->setAdresseInsta($data["adresseInsta"]);
        $objOrgaById->setAdresseFB($data["adresseFB"]);
        $objOrgaById->setAdresseSite($data["adresseSite"]);
        $objOrgaById->setImage($data["image"]);

        return $objOrgaById;
    }

    function selectAllOrgaByIdUser(int $id): ?Organisateur
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM organisateur WHERE idUser = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $objOrgaById = new Organisateur;
        $objOrgaById->setIdOrga($data["idOrga"]);
        $objOrgaById->setNom($data["nom"]);
        $objOrgaById->setAdresse($data["adresse"]);
        $objOrgaById->setCodePostal($data["codePostal"]);
        $objOrgaById->setVille($data["ville"]);
        $objOrgaById->setDescription($data["description"]);
        $objOrgaById->setEmail($data["email"]);
        $objOrgaById->setTelephone($data["telephone"]);
        $objOrgaById->setAdresseTwitter($data["adresseTwitter"]);
        $objOrgaById->setAdresseInsta($data["adresseInsta"]);
        $objOrgaById->setAdresseFB($data["adresseFB"]);
        $objOrgaById->setAdresseSite($data["adresseSite"]);
        $objOrgaById->setImage($data["image"]);
        $objOrgaById->setDateCreation($data["dateCreation"]);

        return $objOrgaById;
    }


    function updateOrga(Organisateur $objInsert, int $id)
    {
        $nom = $objInsert->getNom();
        $adresse = $objInsert->getAdresse();
        $codePostal = $objInsert->getCodePostal();
        $ville = $objInsert->getVille();
        $description = $objInsert->getDescription();
        $email = $objInsert->getEmail();
        $telephone = $objInsert->getTelephone();
        $adresseTwitter = $objInsert->getAdresseTwitter();
        $adresseInsta = $objInsert->getAdresseInsta();
        $adresseFB = $objInsert->getAdresseFB();
        $adresseSite = $objInsert->getAdresseSite();
        $image = $objInsert->getImage();
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE organisateur SET
        nom = ?, 
        adresse= ?, 
        codePostal= ?, 
        ville= ?, 
        description= ?, 
        email= ?, 
        telephone= ?, 
        adresseTwitter= ?, 
        adresseInsta= ?, 
        adresseFB= ?, 
        adresseSite= ?, 
        image= ? 
        WHERE idOrga = ?;");
        $stmt->bind_param(
            "ssisssssssssi",
            $nom,
            $adresse,
            $codePostal,
            $ville,
            $description,
            $email,
            $telephone,
            $adresseTwitter,
            $adresseInsta,
            $adresseFB,
            $adresseSite,
            $image,
            $id
        );
        $stmt->execute();
        $bdd->close();
    }

    function insertOrga(Organisateur $objInsert)
    {
        $bdd = $this->connexion();
        $nom = $objInsert->getNom();
        $adresse = $objInsert->getAdresse();
        $codePostal = $objInsert->getCodePostal();
        $ville = $objInsert->getVille();
        $description = $objInsert->getDescription();
        $email = $objInsert->getEmail();
        $telephone = $objInsert->getTelephone();
        $adresseTwitter = $objInsert->getAdresseTwitter();
        $adresseInsta = $objInsert->getAdresseInsta();
        $adresseFB = $objInsert->getAdresseFB();
        $adresseSite = $objInsert->getAdresseSite();
        $idUser = $objInsert->getIdUser();
        $image = $objInsert->getImage();
        $stmt = $bdd->prepare(" INSERT INTO organisateur(
            nom, adresse, codePostal, ville, description, email, telephone, adresseTwitter, adresseInsta, adresseFB, adresseSite, idUser, image) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param(
            "sssssssssssis",
            $nom,
            $adresse,
            $codePostal,
            $ville,
            $description,
            $email,
            $telephone,
            $adresseTwitter,
            $adresseInsta,
            $adresseFB,
            $adresseSite,
            $idUser,
            $image
        );

        $stmt->execute();
        $id = $stmt->insert_id;
        $bdd->close();
        return $id;
    }

    function deleteOrga($id)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("DELETE FROM  organisateur WHERE idOrga = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $bdd->close();
    }
    function selectNameByIdOrga(int $id): Organisateur
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT nom FROM organisateur WHERE idOrga = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $nameIdOrga = new Organisateur;
        $nameIdOrga->setNom($data["nom"]);

        return $nameIdOrga;
    }

    function selectAllNoobOrga(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM organisateur as o INNER JOIN utilisateur AS u WHERE o.idUser = u.idUser AND u.profil = 'noob'");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabEvent = [];
        foreach ($data as $d) {
            $objOrga = new Organisateur;
            $objOrga->setIdOrga($d["idOrga"]);
            $objOrga->setNom($d["nom"]);
            $objOrga->setAdresse($d["adresse"]);
            $objOrga->setCodePostal($d["codePostal"]);
            $objOrga->setVille($d["ville"]);
            $objOrga->setDescription($d["description"]);
            $objOrga->setEmail($d["email"]);
            $objOrga->setTelephone($d["telephone"]);
            $objOrga->setAdresseTwitter($d["adresseTwitter"]);
            $objOrga->setAdresseInsta($d["adresseInsta"]);
            $objOrga->setAdresseFB($d["adresseFB"]);
            $objOrga->setAdresseSite($d["adresseSite"]);
            $objOrga->setImage($d["image"]);
            $objOrga->setDateCreation($d["dateCreation"]);
            $tabEvent[] = $objOrga;
        }
        return $tabEvent;
    }

    function selectAllUserOrga(): array
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT * FROM organisateur as o INNER JOIN utilisateur AS u WHERE o.idUser = u.idUser AND u.profil = 'user'");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $tabEvent = [];
        foreach ($data as $d) {
            $objOrga = new Organisateur;
            $objOrga->setIdOrga($d["idOrga"]);
            $objOrga->setNom($d["nom"]);
            $objOrga->setAdresse($d["adresse"]);
            $objOrga->setCodePostal($d["codePostal"]);
            $objOrga->setVille($d["ville"]);
            $objOrga->setDescription($d["description"]);
            $objOrga->setEmail($d["email"]);
            $objOrga->setTelephone($d["telephone"]);
            $objOrga->setAdresseTwitter($d["adresseTwitter"]);
            $objOrga->setAdresseInsta($d["adresseInsta"]);
            $objOrga->setAdresseFB($d["adresseFB"]);
            $objOrga->setAdresseSite($d["adresseSite"]);
            $objOrga->setImage($d["image"]);
            $objOrga->setDateCreation($d["dateCreation"]);
            $tabEvent[] = $objOrga;
        }
        return $tabEvent;
    }

    function selectIdOrgaByName($name)
    {
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("SELECT idOrga FROM organisateur WHERE nom = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $result->free();
        $bdd->close();
        $idOrga = $data["idOrga"];
        return $idOrga;
    }
}
