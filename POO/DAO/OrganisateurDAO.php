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

    function selectAllOrgaByIdUser(int $id): Organisateur
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

        return $objOrgaById;
    }


    function updateOrga(Organisateur $objInsert, int $id)
    {
        // var_dump($id);
        $nom = $objInsert->getNom();
        // var_dump($nom);
        $adresse = $objInsert->getAdresse();
        // var_dump($adresse);
        $codePostal = $objInsert->getCodePostal();
        // var_dump($codePostal);
        $ville = $objInsert->getVille();
        // var_dump($ville);
        $description = $objInsert->getDescription();
        // var_dump($description);
        $email = $objInsert->getEmail();
        // var_dump($email);
        $telephone = $objInsert->getTelephone();
        // var_dump($telephone);
        $adresseTwitter = $objInsert->getAdresseTwitter();
        // var_dump($adresseTwitter);
        $adresseInsta = $objInsert->getAdresseInsta();
        // var_dump($adresseInsta);
        $adresseFB = $objInsert->getAdresseFB();
        // var_dump($adresseFB);
        $adresseSite = $objInsert->getAdresseSite();
        // var_dump($adresseSite);
        $image = $objInsert->getImage();
        // var_dump($image);
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
        // var_dump($stmt);
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
        $bdd->close();
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
}
