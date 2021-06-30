<?php

include_once("Fonctions.php");

function afficherAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("Administration", "..\Presentation\CSS\style_orga.css");
    ?>

    <body>
        <?php
        viewBodyAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent);
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="../Presentation/JS/scriptCarrousel.js"></script>

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




function viewBodyAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent)
{
?>
    <div class="page">

        <div class="header">
            Toute l'actualité culturelle de Roubaix
            <a href="AccueilAgenda.php"><img class="logo" src="..\Presentation\Images\logo.png"></a>
        </div>



        <div class="aside">
            <h2>Comptes organisateur à valider</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Valider</th>
                </tr>
                <?php
                foreach ($tabOrgaNoob as $orgaNoob) {
                ?>

                    <tr>
                        <td> <a href="AffichageOrga.php?id=<?php echo $orgaNoob->getIdOrga() ?>"><?php echo $orgaNoob->getNom() ?></a></td>
                        <td> <?php echo $orgaNoob->getEmail() ?> </td>
                        <td> <?php echo $orgaNoob->getTelephone() ?> </td>
                        <td> <a href="validate.php?id=<?php echo $orgaNoob->getIdUser() ?>"><button class="btn btn-primary">Valider</button> </a></td>
                    </tr>
                <?php
                }
                ?>
            </table>

        </div>

        <div class="section">
            <h2>Organisateurs</h2>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                </tr>
                <?php
                foreach ($tabOrgaUser as $orgaUser) {
                ?>


                    <tr>
                        <td> <a href="AffichageOrga.php?id=<?php echo $orgaUser->getIdOrga() ?>"><?php echo $orgaUser->getNom() ?></a></td>
                        <td> <?php echo $orgaUser->getEmail() ?> </td>
                        <td> <?php echo $orgaUser->getTelephone() ?> </td>
                    </tr>


                <?php
                }
                ?>
            </table>
        </div>

        <h2>Derniers évenements publiés</h2>
        <div class="footer">
            <div id="wrapper">
                <div id="carousel">
                    <div id="content">
                        <?php foreach ($tabLastPublishedEvent as $value) { ?>
                            <a href="AffichageEvent.php?id=<?php echo $value->getIdEvent() ?>"><img class="item" src="data:image/jpg;base64,<?php echo base64_encode($value->getImage()) ?>" /></a>
                        <?php } ?>
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
