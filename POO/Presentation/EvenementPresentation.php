<?php

function afficherEvent($objEvent, $profil)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("Evenement", "..\Presentation\CSS\style_page_event.css");
    ?>

    <body>
        <?php
        viewBodyEvent($objEvent, $profil);
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    </html>
<?php
}
function afficherHead($nomPage, $fichierCSS)
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
                    } ?> </ul>
<?php
};

function viewBodyEvent($objEvent, $profil)
{
?>
    <div class="page">
        <div class="header">
            Toute l'actualité culturelle de Roubaix
            <a href="../page-acceuil/acceuil.html"><img class="logo" src="..\Presentation\Images\logo.png"></a>
        </div>
        <div class="aside">
            <div class="labeltitre"><?php echo $objEvent->getNom() ?></div>
            <hr>
            <div class="ligne">
                <div class="labeldate col-md-6">Le : <?php echo $objEvent->getDate() ?></div>
                <div class="labeldate col-md-6">à : <?php echo $objEvent->getHeure() ?></div>
            </div>
            <hr>
            <div class="labeldate">
                <div class="labeldate col-md-6">Lieu : <?php echo $objEvent->getLieu() ?></div>
            </div>
            <div class=label> 31 Rue de l'Epeule </br> 59100 Roubaix</br> Infos et réservations : </br>
                Téléphone : 03 20 24 47 </br> E-mail: coliseerbx@gmail.com </div>
            <hr>
            <div class="ligne">
                <a href="accueil_agenda.html" class="tag">#HipHop</a>
                <a href="accueil_agenda.html" class="tag">#Concert</a>
                <a href="accueil_agenda.html" class="tag">#Sheguey</a>
                <a href="accueil_agenda.html" class="tag">#Bob</a>
            </div>
            <div class="label"><?php echo $objEvent->getDescription() ?>
            </div>
        </div>
        <div class="section">
            <img class="illustration" src="data:image/jpg;base64,<?php echo base64_encode($objEvent->getImage()) ?>" alt=" Photo de l'evenement" />
        </div>

        <div class="footer">
            <hr>
            <div class="demi col-lg-6">

                <button class="btn btn-primary" type="button">Editer l'événement</button>

            </div>
            <hr>
            <div class="demi col-lg-6">
                Evenement proposé par
                <pre> </pre>
                <a class="tag" href="page_orga.html">
                    <div class="labeldate col-md-6"><?php echo $objEvent->getLieu() ?></div>
                </a>
                <div>


                </div>
            <?php
        };

        function viewBodyFormInsertEvent($isThereError)
        {
            ?>
                <div class="page">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="header">
                            Toute l'actualité culturelle de Roubaix
                            <img class="logo" src="img/Logo.png" />
                        </div>
                        <div class="aside">
                            <div class=label>
                                Détails de l'événement :
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nom de l'événement" aria-label="Nom de l'événement" aria-describedby="basic-addon2" name="nomEvent" value="<?php if ($isThereError) {
                                                                                                                                                                                                        echo $_POST["nomEvent"];
                                                                                                                                                                                                    }; ?>" />
                                </div>
                                <hr />
                                <div class="ligne">
                                    <div class="labeldate col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" placeholder="Date de l'évenement" aria-label="Date de l'évenement" aria-describedby="basic-addon2" name="dateEvent" value="<?php if ($isThereError) {
                                                                                                                                                                                                                    echo $_POST["dateEvent"];
                                                                                                                                                                                                                }; ?>" />
                                        </div>
                                    </div>
                                    <div class="labeldate col-md-6">
                                        <input type="time" class="form-control" placeholder="Heure de l'évenement" aria-label="Heure de l'évenement" aria-describedby="basic-addon2" name="heureEvent" value="<?php if ($isThereError) {
                                                                                                                                                                                                                    echo $_POST["heureEvent"];
                                                                                                                                                                                                                }; ?>" />
                                    </div>
                                </div>
                                <hr />
                                <div class="labeldate">
                                    <input type="text" class="form-control" placeholder="Lieu de l'évenement" aria-label="Lieu de l'évenement" aria-describedby="basic-addon2" name="lieuEvent" value="<?php if ($isThereError) {
                                                                                                                                                                                                            echo $_POST["lieuEvent"];
                                                                                                                                                                                                        }; ?>" />
                                </div>
                                <div class="label">
                                    <div class="input-group">
                                        <textarea class="form-control" placeholder="Adresse de l'événement" aria-label="With textarea" name="adresseEvent" value="<?php if ($isThereError) {
                                                                                                                                                                        echo $_POST["adresseEvent"];
                                                                                                                                                                    }; ?>"></textarea>
                                    </div>
                                </div>
                                Infos et réservations :

                                <input type="text" class="form-control" placeholder="Numéro de téléphone" aria-label="Numéro de téléphone" aria-describedby="basic-addon2" name="telephone" value="<?php if ($isThereError) {
                                                                                                                                                                                                        echo $_POST["telephone"];
                                                                                                                                                                                                    }; ?>" />
                                <input type="mail" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon2" name="email" value="<?php if ($isThereError) {
                                                                                                                                                                            echo $_POST["email"];
                                                                                                                                                                        }; ?>" />
                            </div>
                            <hr />
                            <div class="label">
                                Saisie des tags :
                                <div class="ligne">
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                </div>
                            </div>
                            <div class="label">
                                Description :
                                <div class="input-group-lg">
                                    <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description" value="<?php if ($isThereError) {
                                                                                                                                                        echo $_POST["description"];
                                                                                                                                                    }; ?>"></textarea>
                                </div>
                            </div>
                            <hr />
                        </div>
                        <div class="section">
                            <label class="center" for="avatar">Choisissez une image d'illustration:</label>

                            <input class="center" type="file" id="avatar" name="image" accept="image/png, image/jpeg" />
                            <label for="avatar" class="center">Saisissez l'adresse du lien associé à l'image :</label>

                            <input class="center" type="text" class="form-control" placeholder="adresse du lien" aria-label="adresse du lien" aria-describedby="basic-addon2" name="urlLien" value="<?php if ($isThereError) {
                                                                                                                                                                                                        echo $_POST["urlLien"];
                                                                                                                                                                                                    }; ?>" />
                        </div>
                        <div class=" footer">
                            <hr />
                            <div class="demi col-md-6">
                                <button class="btn btn-primary" type="submit">Annuler</button>
                                <button class="btn btn-primary" type="submit">Supprimer</button>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>
                            <hr />
                            <div class="demi col-md-6">
                                Evenement proposé par
                                <!--récuperer $_POST de l'orga -->le Colisée
                            </div>
                        </div>
                </div>
            <?php
        }

        function viewBodyFormModifEvent($isThereError, $data)
        {
            ?>
                <div class="page">
                    <form action="" method="post" name="formule" enctype="multipart/form-data">
                        <div class="header">
                            Toute l'actualité culturelle de Roubaix
                            <img class="logo" src="img/Logo.png" />
                        </div>
                        <div class="aside">
                            <div class=label>
                                Détails de l'événement :
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Nom de l'événement" aria-label="Nom de l'événement" aria-describedby="basic-addon2" name="nomEvent" value="<?php echo $isThereError ? $_POST["nomEvent"] : $data->getNom(); ?>" />
                                </div>
                                <hr />
                                <div class="ligne">
                                    <div class="labeldate col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Date de l'évenement" aria-label="Date de l'évenement" aria-describedby="basic-addon2" name="dateEvent" value="<?php echo $isThereError ? $_POST["dateEvent"] : $data->getDate(); ?>" />
                                        </div>
                                    </div>
                                    <div class="labeldate col-md-6">
                                        <input type="text" class="form-control" placeholder="Heure de l'évenement" aria-label="Heure de l'évenement" aria-describedby="basic-addon2" name="heureEvent" value="<?php echo $isThereError ? $_POST["heureEvent"] : $data->getHeure(); ?>" />
                                    </div>
                                </div>
                                <hr />
                                <div class="labeldate">
                                    <input type="text" class="form-control" placeholder="Lieu de l'évenement" aria-label="Lieu de l'évenement" aria-describedby="basic-addon2" name="lieuEvent" value="<?php echo $isThereError ? $_POST["lieuEvent"] : $data->getLieu(); ?>" />
                                </div>
                                <div class="label">
                                    <div class="input-group">
                                        <textarea class="form-control" placeholder="Adresse de l'événement" aria-label="With textarea" name="adresseEvent" value="<?php echo $isThereError ? $_POST["adresseEvent"] : $data->getLieu(); ?>"></textarea>
                                    </div>
                                </div>
                                Infos et réservations :

                                <input type="text" class="form-control" placeholder="Numéro de téléphone" aria-label="Numéro de téléphone" aria-describedby="basic-addon2" name="telephone" value="<?php echo $isThereError ? $_POST["telephone"] : $data->getTelephone(); ?>" />
                                <input type="text" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon2" name="email" value="<?php echo $isThereError ? $_POST["email"] : $data->getEmail(); ?>" />
                            </div>
                            <hr />
                            <div class="label">
                                Saisie des tags :
                                <div class="ligne">
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                    <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag" />
                                </div>
                            </div>
                            <div class="label">
                                Description :
                                <div class="input-group-lg">
                                    <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description" value="<?php echo $isThereError ? $_POST["description"] : $data->getDescription(); ?>"></textarea>
                                </div>
                            </div>
                            <hr />
                        </div>
                        <div class="section">
                            <label class="center" for="avatar">Choisissez une image d'illustration:</label>

                            <input class="center" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
                            <label for="avatar" class="center">Saisissez l'adresse du lien associé à l'image :</label>

                            <input class="center" type="text" class="form-control" placeholder="adresse du lien" aria-label="adresse du lien" aria-describedby="basic-addon2" name="urlLien" value="<?php echo $isThereError ? $_POST["urlLien"] : $data->getUrlLien(); ?>" />
                        </div>
                        <div class=" footer">
                            <hr />
                            <div class="demi col-md-6">
                                <button class="btn btn-primary" type="submit">Annuler</button>
                                <button class="btn btn-primary" type="submit">Supprimer</button>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>
                            <hr />
                            <div class="demi col-md-6">
                                Evenement proposé par
                                <!--récuperer $_POST de l'orga -->le Colisée
                            </div>
                        </div>
                </div>
            <?php
        }
        function afficherFormModifEvent($isThereError, $messages, $data)
        {
            ?>
                <!DOCTYPE html>
                <html lang="en">
                <?php
                afficherHead("Modifier Evenement", "..\Presentation\CSS\style_form_event.css");
                ?>

                <body>
                    <?php
                    erreurView($isThereError, $messages);
                    viewBodyFormModifEvent($isThereError, $data);
                    ?>
                </body>

                </html>
            <?php
        }
        function afficherFormInsertEvent($isThereError, $messages)
        { ?>
                <!DOCTYPE html>
                <html lang="en">
                <?php
                afficherHead("Créer un evenement", "..\Presentation\CSS\style_form_event.css");
                ?>

                <body>
                    <?php
                    erreurView($isThereError, $messages);
                    viewBodyFormInsertEvent($isThereError);
                    ?>
                </body>

                </html>
            <?php
        };
            ?>