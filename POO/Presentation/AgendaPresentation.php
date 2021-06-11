<?php

include_once(__DIR__ . "/../Model/Evenement.php");
include_once("Fonctions.php");















function afficherAgenda($objEvent, $profil, $orga)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php
        afficherHead("L'agenda", "..\Presentation\CSS\style_agenda.css");
        ?>
    </head>

    <body>
        <?php
        viewAgendaBody($objEvent, $profil, $orga);
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


    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo ($fichierCSS) ?>" />
    <title><?php echo ($nomPage) ?></title>



<?php
};













function viewAgendaBody($objEvent, $profil, $orga)
{
?>


    <div class="container-fluid">
        <!-- Bannière -->
        <div class="row header1">
            <div class="col-md-10">
                <h1>Toute l'actualité culturelle de Roubaix</h1>
            </div>

            <div class="col-md-2 logoDroite"><a href="AccueilAgenda.php"><img src="..\Presentation\Images\logo.png" alt="" height="80px"></a></div>
            <hr>
        </div>

        <!-- 3 colonnes -->
        <div class="row">
            <!-- colonne gauche -->
            <div class="col-md-2 coteGauche">
                <nav class="navbar">
                    <div class="container fluid">
                        <form class="d-flex" style="width:100%;">
                            <input class="form-control me-2" type="search" placeholder="rechercher un organisateur" aria-label="Search">
                        </form>
                    </div>
                </nav>
                <nav class="navbar">
                    <div class="container fluid">
                        <form class="d-flex" style="width:100%;">
                            <input class="form-control me-2" type="date" placeholder="rechercher une date" aria-label="Search">
                        </form>
                    </div>
                </nav>
                <nav class="navbar">
                    <div class="container fluid">
                        <form class="d-flex" style="width:100%;">
                            <input class="form-control me-2" type="search" placeholder="rechercher un tag" aria-label="Search">
                        </form>
                    </div>
                    <div class="container box_search">
                        <a href="#" class="badge badge-dark">#musique</a>
                        <a href="#" class="badge badge-dark">#foot</a>
                        <a href="#" class="badge badge-dark">#musée</a>
                        <a href="#" class="badge badge-dark">#jeunesse</a>
                        <a href="#" class="badge badge-dark">#sport</a>
                        <a href="#" class="badge badge-dark">#cinéma</a>
                    </div>
                </nav>

            </div>


            <!-- colonne centrale -->
            <div class="col-lg-8 col-md-9 col-sm-9 centre">


                <div class="row ligneCard">
                    <?php
                    $lastEvent = new Evenement;

                    foreach ($objEvent as $event) {
                        if ($event->getDate() != $lastEvent->getDate()) {
                    ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h2> <?php echo dateToFrench($event->getDate(), "l j F Y"); ?></h2>
                                </div>
                            </div>
                            <hr />
                        <?php
                        }
                        ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card boxEvenemt">
                                <a href="AffichageEvent.php?id=<?php echo $event->getIdEvent() ?>"><img src="data:image/jpg;base64,<?php echo base64_encode($event->getImage()) ?>" class="card-img-top" alt="..."></a>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $event->getNom() ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                        $lastEvent = $event;
                    }
                    ?>
                </div>
            </div>


            <!-- colonne droite -->
            <div class="col-lg-2 col-md-3 col-sm-3 coteDroit">
                <div class="menuCoterDroite">
                    <?php
                    if (!isset($_SESSION["profil"])) { ?>
                        <a href="Inscription.php" class="btn btn-secondary bouton">M'inscrire</a>
                        <a href="Connexion.php" class="btn btn-secondary bouton">Me connecter</a>

                    <?php } elseif ($_SESSION["profil"] == "user" || $_SESSION["profil"] ==  "noob") { ?>

                        <a href="AffichageOrga.php?id=<?php echo $profil["idOrga"] ?>" class="btn btn-secondary bouton">Mon compte</a>
                        <a href="Deconnexion.php" class="btn btn-secondary bouton">Me déconnecter</a>

                    <?php } elseif ($_SESSION["profil"] == "admin") { ?>
                        <a href="PageAdmin.php" class="btn btn-secondary bouton">Administration</a>
                        <a href="Deconnexion.php" class="btn btn-secondary bouton">Me déconnecter</a>
                    <?php } ?>
                    <div class="card boxOrga">
                        <?php foreach ($orga as $o) { ?>
                            <a href="AffichageOrga.php?id=<?php echo $o->getIdOrga() ?>"><img src="data:image/jpg;base64,<?php echo base64_encode($o->getImage()) ?>" class="card-img-top imgDroite" alt="..."></a>

                            <p class="card-titre"><?php echo $o->getNom() ?></p>
                    </div>
                <?php } ?>

                </div>
            </div>
        </div>
    </div>
<?php


}
