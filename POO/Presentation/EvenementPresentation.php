<?php

include_once("Fonctions.php");




function afficherEvent($objEvent, $profil, $name)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("Evenement", "..\Presentation\CSS\style_page_event.css");
    ?>

    <body>
        <?php
        viewBodyEvent($objEvent, $profil, $name);
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

function viewBodyEvent($objEvent, $profil, $name)
{
?>
    <div class="page">
        <div class="header">
            Toute l'actualité culturelle de Roubaix
            <a href="AccueilAgenda.php"><img class="logo" src="..\Presentation\Images\logo.png"></a>
        </div>
        <div class="aside">
            <div class="labeltitre"><?php echo $objEvent->getNom() ?></div>
            <hr>
            <div class="ligne">
                <div class="labeldate col-md-6"> <?php echo dateToFrench($objEvent->getDate(), "l j F Y"); ?></div>
                <div class="labeldate col-md-6">à <?php echo $objEvent->getHeure() ?></div>
            </div>
            <hr>
            <div class="labeldate">
                <div class="labeldate col-md-6">Lieu : <?php echo $objEvent->getLieu() ?></div>
            </div>
            <div class="label"><?php echo $objEvent->getDescription() ?>
            </div>
            <hr>
            <div class="ligne">
                <a href="accueil_agenda.html" class="tag"></a>
                <a href="accueil_agenda.html" class="tag">#Concert</a>
                <a href="accueil_agenda.html" class="tag">#Sheguey</a>
                <a href="accueil_agenda.html" class="tag">#Bob</a>
            </div>

        </div>
        <div class="section">
            <img class="illustration" src="data:image/jpg;base64,<?php echo base64_encode($objEvent->getImage()) ?>" alt=" Photo de l'evenement" />
        </div>

        <div class="footer">
            <hr>
            <div class="demi col-lg-6">
                <a href="FormEventModif.php?id=<?php echo $objEvent->getIdEvent() ?>" .><button class="btn btn-primary" type="button">Editer l'événement</button></a>
            </div>
            <hr>
            <div class="demi col-lg-6">
                Evenement proposé par
                <a href="AffichageOrga.php?id=<?php echo $objEvent->getIdOrga() ?>">
                    <div class="labeldate "><?php echo $name->getNom() ?>
                </a>
            </div>
        </div>
    </div>
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
                <a href="AccueilAgenda.php"><img class="logo" src="..\Presentation\Images\logo.png"></a>
            </div>
            <div class="aside">
                <div class=label>
                    Détails de l'événement :
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nom de l'événement" aria-label="Nom de l'événement" aria-describedby="basic-addon2" name="nom" value="<?php if ($isThereError) {
                                                                                                                                                                                        echo $_POST["nom"];
                                                                                                                                                                                    }; ?>" />
                    </div>
                    <hr />
                    <div class="ligne">
                        <div class="labeldate col-md-6">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="Date de l'évenement" aria-label="Date de l'évenement" aria-describedby="basic-addon2" name="date" value="<?php if ($isThereError) {
                                                                                                                                                                                                    echo $_POST["date"];
                                                                                                                                                                                                }; ?>" />
                            </div>
                        </div>
                        <div class="labeldate col-md-6">
                            <input type="time" class="form-control" placeholder="Heure de l'évenement" aria-label="Heure de l'évenement" aria-describedby="basic-addon2" name="heure" value="<?php if ($isThereError) {
                                                                                                                                                                                                    echo $_POST["heure"];
                                                                                                                                                                                                }; ?>" />
                        </div>
                    </div>
                    <hr />
                    <div class="labeldate">
                        <input type="text" class="form-control" placeholder="Lieu de l'évenement" aria-label="Lieu de l'évenement" aria-describedby="basic-addon2" name="lieu" value="<?php if ($isThereError) {
                                                                                                                                                                                            echo $_POST["lieu"];
                                                                                                                                                                                        }; ?>" />
                    </div>
                    <div class="label">
                        Description :
                        <div class="input-group-lg">
                            <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description"><?php if ($isThereError) {
                                                                                                                                        echo $_POST["description"];
                                                                                                                                    }; ?></textarea>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="label">
                    Saisie des tags :
                    <div class="ligne">
                        <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag1" value="<?php if ($isThereError) {
                                                                                                                                                                                echo $_POST["tag1"];
                                                                                                                                                                            }; ?>" />
                        <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag2" value="<?php if ($isThereError) {
                                                                                                                                                                                echo $_POST["tag2"];
                                                                                                                                                                            }; ?>" />
                        <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag3" value="<?php if ($isThereError) {
                                                                                                                                                                                echo $_POST["tag3"];
                                                                                                                                                                            }; ?>" />
                        <input type="text" class="form-control tag" placeholder="#SaisirUnTag" aria-label="#SaisirUnTag" aria-describedby="basic-addon2" name="tag4" value="<?php if ($isThereError) {
                                                                                                                                                                                echo $_POST["tag4"];
                                                                                                                                                                            }; ?>" />
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

            </div>
        </form>
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
                <a href="AccueilAgenda.php"><img class="logo" src="..\Presentation\Images\logo.png"></a>
            </div>
            <div class="aside">
                <div class=label>
                    Détails de l'événement :
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nom de l'événement" aria-label="Nom de l'événement" aria-describedby="basic-addon2" name="nom" value="<?php echo $isThereError ? $_POST["nom"] : $data->getNom(); ?>" />
                    </div>
                    <hr />
                    <div class="ligne">
                        <div class="labeldate col-md-6">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" placeholder="Date de l'évenement" aria-label="Date de l'évenement" aria-describedby="basic-addon2" name="date" value="<?php echo $isThereError ? $_POST["date"] : $data->getDate(); ?>" />
                            </div>
                        </div>
                        <div class="labeldate col-md-6">
                            <input type="time" class="form-control" placeholder="Heure de l'évenement" aria-label="Heure de l'évenement" aria-describedby="basic-addon2" name="heure" value="<?php echo $isThereError ? $_POST["heure"] : $data->getHeure(); ?>" />
                        </div>
                    </div>
                    <hr />
                    <div class="labeldate">
                        <input type="text" class="form-control" placeholder="Lieu de l'évenement" aria-label="Lieu de l'évenement" aria-describedby="basic-addon2" name="lieu" value="<?php echo $isThereError ? $_POST["lieu"] : $data->getLieu(); ?>" />
                    </div>

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
                        <textarea class="form-control" placeholder="Description" aria-label="With textarea" name="description"><?php echo $isThereError ? $_POST["description"] : $data->getDescription(); ?></textarea>
                    </div>
                </div>
                <hr />
            </div>
            <div class="section">
                <label class="center" for="avatar">Choisissez une image d'illustration:</label>
                <input class="center" type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />

                <label for="avatar" class="center">Saisissez l'adresse du lien associé à l'image :</label>
                <input class="center" type="text" class="form-control" placeholder="adresse du lien" aria-label="adresse du lien" aria-describedby="basic-addon2" name="urlLien" value="<?php echo $isThereError ? $_POST["urlLien"] : $data->getUrlLien(); ?>" />

                <img class="illustration" src="data:image/jpg;base64,<?php echo base64_encode($data->getImage()) ?>" alt=" Photo de l'organisateur" />


            </div>
            <div class=" footer">
                <hr />
                <div class="demi col-md-6">
                    <button class="btn btn-primary" type="submit">Annuler</button>
                    <button class="btn btn-primary" type="submit">Supprimer</button>
                    <button class="btn btn-primary" type="submit">Valider</button>
                </div>
                <hr />

            </div>
        </form>
    </div>
<?php
}





function afficherFormModifEvent($isThereError, $messages, $data)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("Modifier Evenement", "..\Presentation\CSS\style_form_orga.css");
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
    afficherHead("Créer un evenement", "..\Presentation\CSS\style_form_orga.css");
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