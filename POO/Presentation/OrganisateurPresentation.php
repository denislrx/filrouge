<?php

function AfficherOrga($objOrga, $profil)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    AfficherHead("Organisateur", "CSS\style_form_orga.css");
    ?>

    <body>
        <?php
        ViewBodyOrga($objOrga, $profil);
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    </html>
<?php
}

function ViewBodyOrga($objOrga, $profil)
{
?>
    <div class="page">

        <div class="header">
            Toute l'actualité culturelle de Roubaix
            <a href="../page-acceuil/acceuil.html"><img class="logo" src="C:\Users\roten\formation\filrouge\POO\Presentation\Images\logo.png"></a>
        </div>
        <div class="labeltitre switch"><?php echo $objOrga->getNom() ?></div>
        <hr />
        <div class="aside">
            <div class="labeltitre switch2"><?php echo $objOrga->getNom() ?></div>
            <hr />
            <div class="row">
                <div class="col-md-12 label">
                    <?php echo $objOrga->getDescription() ?>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-8 label">
                    <p><?php echo $objOrga->getAdresse() ?></br> <?php echo $objOrga->getCodePostal() ?> </br> <?php echo $objOrga->getVille() ?> </p>
                    <p>Tel : <?php echo $objOrga->getTelephone() ?></p>
                    <p>Mail : <?php echo $objOrga->getEmail() ?></p>
                </div>
                <div class="col-md-3 edition">
                    <?php if ($profil == "user" || $profil == "admin") { ?>
                        <a href="FormEventInsert.php"><button type="button" class="btn btn-outline-secondary">Ajouter un événement</button></a>
                        <a href="FormOrgaModif.php?id=<?php echo $objOrga->getIdOrga() ?>"><button type="button" class="btn btn-outline-secondary">Modifier la page</button></a>
                    <?php } ?>
                </div>
                <hr />
                <div class="ligne">
                    <a href="<?php echo $objOrga->getAdresseFB() ?>"><img class="logoRS" src="img/fb.png" /></a>
                    <a href="<?php echo $objOrga->getAdresseTwitter() ?>"><img class="logoRS" src="img/twit.png" /></a>
                    <a href="<?php echo $objOrga->getAdresseInsta() ?>"><img class="logoRS" src="img/insta.png" /></a>
                </div>
            </div>
            <hr />
        </div>


        <div class="section">
            <img class="illustration" src="<?php echo $objOrga->getImage() ?>"" alt=" Photo de l'organisateur">
        </div>

        <div class="footer">
            <div id="wrapper">
                <div id="carousel">
                    <div id="content">
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                        <a href="https://www.coliseeroubaix.com/"><img src="img/concert.jpg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/gradur.jpeg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/jcc.jpg" class="item" /></a>
                        <a href="https://www.coliseeroubaix.com/"><img src="img/concert.jpg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/gradur.jpeg" class="item" /></a>
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/jcc.jpg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/gradur.jpeg" class="item" /></a>
                        <a href="https://www.coliseeroubaix.com/"><img src="img/concert.jpg" class="item" /></a>
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/jcc.jpg" class="item" /></a>
                        <a href="https://www.coliseeroubaix.com/"><img src="img/concert.jpg" class="item" /></a>
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/gradur.jpeg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/jcc.jpg" class="item" /></a>
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                        <a href="https://www.coliseeroubaix.com/"><img src="img/concert.jpg" class="item" /></a>
                        <a href="https://www.lecomedyclub.com/fr"><img src="img/jcc.jpg" class="item" /></a>
                        <a href="https://www.ugc.fr/cinema.html?id=51"><img class="item" src="img/cinema.jpg" /></a>
                    </div>
                </div>
                <button id="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z" />
                        <path d="M15.61 7.41L14.2 6l-6 6 6 6 1.41-1.41L11.03 12l4.58-4.59z" />
                    </svg>
                </button>
                <button id="next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z" />
                        <path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z" />
                    </svg>
                </button>
            </div>
        </div>


    </div>
    </body>
<?php
}

function AfficherFormOrgaInsert($isThereError, $messages)
{ ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php

    AfficherHead("Créer un compte organisateur", "../Presentation/CSS/style_form_orga.css");
    ?>

    <body>
        <?php
        erreurView($isThereError, $messages);
        ViewBodyFormOrgaInsert($isThereError);
        ?>
    </body>

    </html>
<?php
};

function AfficherHead($nomPage, $fichierCSS)
{
?>

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?php echo ($fichierCSS) ?>" />
        <title><?php echo ($nomPage) ?></title>
    </head>

<?php
};

function erreurView($er, $messageErr)
{
?>
    <ul>
        <?php

        if ($er) {
            foreach ($messageErr as $message) {
        ?> <li> <?php
                echo $message;
                ?> </li> <?php
                        }
                    } ?>
    </ul>

<?php
};


function ViewBodyFormOrgaInsert($isThereError)
{
?>


    <div class="page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="header">
                Toute l'actualité culturelle de Roubaix
                <img class="logo" src="..\Presentation\Images\logo.png" />
            </div>

            <div class="aside">
                <div class="titre">Détails de l'organisateur :</div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Nom de l'organisateur" aria-label="Nom de l'organisateur" aria-describedby="basic-addon2" name="nom" value="<?php if ($isThereError) {
                                                                                                                                                                                            echo $_POST["nom"];
                                                                                                                                                                                        }; ?>" />
                </div>
                <hr />
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse" aria-label="Adresse" aria-describedby="basic-addon2" name="adresse" value="<?php if ($isThereError) {
                                                                                                                                                                    echo $_POST["adresse"];
                                                                                                                                                                }; ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Code Postal" aria-label="Code Postal" aria-describedby="basic-addon2" name="codePostal" value="<?php if ($isThereError) {
                                                                                                                                                                            echo $_POST["codePostal"];
                                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Ville" aria-label="Ville" aria-describedby="basic-addon2" name="ville" value="<?php if ($isThereError) {
                                                                                                                                                            echo $_POST["ville"];
                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisiedescr">
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description" value="<?php if ($isThereError) {
                                                                                                                                            echo $_POST["description"];
                                                                                                                                        }; ?>"></textarea>
                    </div>
                </div>
                <div class="titre">Contacts :</div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Numéro de téléphone" aria-label="Numéro de téléphone" aria-describedby="basic-addon2" name="telephone" value="<?php if ($isThereError) {
                                                                                                                                                                                            echo $_POST["telephone"];
                                                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisie">
                    <input type="email" class="form-control" placeholder="exemple@exemple.com" aria-label="E-mail" aria-describedby="basic-addon2" name="email" value="<?php if ($isThereError) {
                                                                                                                                                                            echo $_POST["email"];
                                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="www.facebook.com/votrenomdutilisateur" aria-label="Adresse Facebook" aria-describedby="basic-addon2" name="adresseFB" value="<?php if ($isThereError) {
                                                                                                                                                                                                            echo $_POST["adresseFB"];
                                                                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="@AdresseTwitter" aria-label="Adresse Twitter" aria-describedby="basic-addon2" name="adresseTwitter" value="<?php if ($isThereError) {
                                                                                                                                                                                        echo $_POST["adresseTwitter"];
                                                                                                                                                                                    }; ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="@adresseInstagram" aria-label="Adresse Instagram" aria-describedby="basic-addon2" name="adresseInsta" value="<?php if ($isThereError) {
                                                                                                                                                                                            echo $_POST["adresseInsta"];
                                                                                                                                                                                        }; ?>" />
                </div>
                <div class="saisie">
                    <input type="url" class="form-control" placeholder="Adresse Site" aria-label="Adresse Site" aria-describedby="basic-addon2" name="adresseSite" value="<?php if ($isThereError) {
                                                                                                                                                                                echo $_POST["adresseSite"];
                                                                                                                                                                            }; ?>" />

                </div>
                <hr />
            </div>

            <div class="section">
                <label class="center" for="avatar">Choisissez une image d'illustration:
                </label>

                <input class="center" type="file" id="image" name="image" accept="image/png, image/jpeg" />
            </div>
            <div class="footer">
                <hr />
                <div class="demi col-md-6">
                    <button class="btn btn-primary" type="reset">Annuler</button>
                    <!-- <button class="btn btn-primary" >Supprimer</button> -->
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
                <hr />

                <div class="demi col-md-6">

                </div>
        </form>
    </div>


<?php
}




function AfficherModifFormOrga($isThereError, $messages, $data)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    AfficherHead("Modifier Organisateur", "filrouge\POO\CSS\style_form_orga.css");
    ?>

    <body>
        <?php
        erreurView($isThereError, $messages);
        ViewBodyFormOrgaModif($isThereError, $data);
        ?>
    </body>

    </html>
<?php
}

function ViewBodyFormOrgaModif($isThereError, $data)
{
?>


    <div class="page">
        <form action="" method="post" name="formule" enctype="multipart/form-data">
            <div class="header">
                Toute l'actualité culturelle de Roubaix
                <img class="logo" src="C:\Users\roten\formation\filrouge\POO\Presentation\Images\logo.png" />
            </div>

            <div class="aside">
                <div class="titre">Détails de l'organisateur :</div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Nom de l'organisateur" aria-label="Nom de l'organisateur" aria-describedby="basic-addon2" name="nom" value="<?php echo $isThereError ? $_POST["nom"] : $data->getNom(); ?>" />
                </div>
                <hr />
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse" aria-label="Adresse" aria-describedby="basic-addon2" name="adresse" value="<?php echo $isThereError ? $_POST["adresse"] : $data->getAdresse(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Code Postal" aria-label="Code Postal" aria-describedby="basic-addon2" name="codePostal" value="<?php echo $isThereError ? $_POST["codePostal"] : $data->getCodePostal(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Ville" aria-label="Ville" aria-describedby="basic-addon2" name="ville" value="<<?php echo $isThereError ? $_POST["ville"] : $data->getVille(); ?>" />
                </div>
                <div class="saisiedescr">
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description" value="<?php echo $isThereError ? $_POST["description"] : $data->getDescription(); ?>"></textarea>
                    </div>
                </div>
                <div class="titre">Contacts :</div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Numéro de téléphone" aria-label="Numéro de téléphone" aria-describedby="basic-addon2" name="telephone" value="<?php echo $isThereError ? $_POST["telephone"] : $data->getTelephone(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon2" name="email" value="<?php echo $isThereError ? $_POST["email"] : $data->getEmail(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse Facebook" aria-label="Adresse Facebook" aria-describedby="basic-addon2" name="adresseFB" value="<?php echo $isThereError ? $_POST["adresseFB"] : $data->getAdresseFB(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse Twitter" aria-label="Adresse Twitter" aria-describedby="basic-addon2" name="adresseTwitter" value="<?php echo $isThereError ? $_POST["adresseTwitter"] : $data->getAdresseTwitter(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse Instagram" aria-label="Adresse Instagram" aria-describedby="basic-addon2" name="adresseInsta" value="<?php echo $isThereError ? $_POST["adresseInsta"] : $data->getAdresseInsta(); ?>" />
                </div>
                <div class="saisie">
                    <input type="text" class="form-control" placeholder="Adresse Site" aria-label="Adresse Site" aria-describedby="basic-addon2" name="adresseSite" value="<?php echo $isThereError ? $_POST["adresseSite"] : $data->getAdresseSite(); ?>" />

                </div>
                <hr />
            </div>

            <div class="section">
                <label class="center" for="avatar">Choisissez une image d'illustration:
                </label>

                <input class="center" type="file" id="image" name="image" accept="image/png, image/jpeg" />
            </div>
            <div class="footer">
                <hr />
                <div class="demi col-md-6">
                    <button class="btn btn-primary" type="reset">Annuler</button>
                    <!-- <button class="btn btn-primary" >Supprimer</button> -->
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
                <hr />

                <div class="demi col-md-6">

                </div>
        </form>
    </div>
    </div>

<?php
}
