<?php

include_once("Fonctions.php");

function afficherAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("Organisateur", "..\Presentation\CSS\style_orga.css");
    ?>

    <body>
        <?php
        viewBodyAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent);
        ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    </html>
<?php
}








function viewBodyAdmin($tabOrgaNoob, $tabOrgaUser, $tabLastPublishedEvent)
{
?>
    <div class="page">

        <div class="header">
            Toute l'actualité culturelle de Roubaix
            <a href="AccueilAgenda.php"><img class="logo" src="..\Presentation\Images\logo.png"></a>
        </div>



        <div class="aside">
            <tr>
                <?php
                foreach ($tabOrgaUser as $orgaUser) {
                ?>


                    <td> <a href="AffichageOrga.php?id=.<?php echo $orgaUser->getIdOrga() ?>"><?php echo $orgaUser->setNom() ?></a>
            </tr>
            <td> <?php echo $orgaUser->setMail() ?> </tr>
            <td> <?php echo $orgaUser->setTelephone() ?> </tr>
                <tr> <a href="validate.php?id=.<?php $orgaUser->getIdUser() ?>"><button class="btn btn-primary">Valider</button> </a>


                <?php
                }
                ?>
                </tr>

        </div>

        <div class="section">
            <tr>
                <?php
                foreach ($tabOrgaNoob as $orgaNoob) {
                ?>


                    <td> <a href="AffichageOrga.php?id=.<?php echo $orgaNoob->getIdOrga() ?>"><?php echo $orgaNoob->setNom() ?></a>
            </tr>
            <td> <?php echo $orgaNoob->setMail() ?> </tr>
            <td> <?php echo $orgaNoob->setTelephone() ?> </tr>
                <tr> <a href="validate.php?id=.<?php $orgaNoob->getIdUser() ?>"><button class="btn btn-primary">Valider</button> </a>


                <?php
                }
                ?>
                </tr>
        </div>

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
