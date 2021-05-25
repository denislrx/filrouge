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
        $idUser = $objInsert->getIdUser();
        $image = $objInsert->getImage();
        $bdd = $this->connexion();
        $stmt = $bdd->prepare("UPDATE organisateur SET
        nom =?, adresse=?, codePostal=?, ville=?, description=?, email, telephone=?, adresseTwitter=?, adresseInsta=?, adresseFB=?, adresseSite=?,idUser=?, image=? WHERE idOrga = ?;");
        $stmt->bind_param(
            "ssissssssssisi",
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
            $image,
            $id
        );
    }

    function insertOrga(Organisateur $objInsert)
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
        $idUser = $objInsert->getIdUser();
        $image = $objInsert->getImage();

        $bdd = $this->connexion();
        $stmt = $bdd->prepare(" INSERT INTO organisateur(
            nom, adresse, codePostal, ville, description, email, telephone, adresseTwitter, adresseInsta, adresseFB, adresseSite, idUser, image) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,9);");
        $stmt->bind_param(
            "ssissssssssis",
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
}
