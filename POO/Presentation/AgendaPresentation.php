<?php

function afficherAgenda($objEvent, $profil)
{
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    afficherHead("L'agenda", "..\Presentation\CSS\style_page_event.css");
    ?>

    <body>
        <?php
        viewAgendaBody($objEvent, $profil);
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

function viewAgendaBody($objEvent, $profil)
{
?>
    <div class="container-fluid">
        <div class="row header1">
            <div class="col-md-10">
                <h1>Toute l'actualité culturelle de Roubaix</h1>
            </div>
            <div class="col-md-2 logoDroite"><img src="img/logo.png" alt="" height="80px"></div>
            <hr>
        </div>

        <div class="row">
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
                <nav class="navbar">
                    <div class="container fluid">
                        <form class="d-flex" style="width:100%;">
                            <input class="form-control me-2" type="date" placeholder="rechercher une date" aria-label="Search">
                        </form>
                    </div>
                    <div class="container box_search">
                        <a href="#" class="badge badge-dark">#demain</a>
                        <a href="#" class="badge badge-dark">#apres demain</a>
                        <a href="#" class="badge badge-dark">#ce week-end</a>
                        <a href="#" class="badge badge-dark">#cette semine</a>
                        <a href="#" class="badge badge-dark">#ce mois</a>
                    </div>
                </nav>
            </div>

            <nav class="navbar navbar-expand-lg bg-light menu">
                <div class="container-fluid BarreNav">
                    <div class="banniere">
                        <div class="col-md-4"><img src="img/logo.png" alt="" height="60px"></div>
                        <div class="col-md-8">
                            <h3>Toute l'actualité culturelle de Roubaix</h3>
                        </div>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span><img src="img/navbar.png" alt=""></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">

                            <div class="row justify-content-center connexionDansMenu">
                                <div class="col deletePaddingConnexion">
                                    <li class="nav-item">
                                        <a href="../form_event/form_event.html" class="btn btn-secondary bouton">Connexion</a>
                                    </li>
                                </div>

                                <div class="col deletePaddingConnexion1">
                                    <li class="nav-item">
                                        <a href="../form_event/form_event.html" class="btn btn-secondary bouton">Sinscrire</a>
                                    </li>
                                </div>

                                <div class="col deletePaddingConnexion2">
                                    <li class="nav-item">
                                        <a href="../form_event/form_event.html" class="btn btn-secondary bouton">Mon compte</a>
                                    </li>
                                </div>
                            </div>

                            <li>
                                <nav class="navbar navbar-light">
                                    <div class="container-fluid barreDeRecherche">
                                        <form class="d-flex">
                                            <input class="form-control me-2 tailleBarre" type="search" placeholder="rechercher un organisateur" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit"><span class="motRechercher">rechercher</span></button>
                                        </form>
                                    </div>
                                </nav>
                            </li>
                            <hr>
                            <li>
                                <nav class="navbar navbar-light">
                                    <div class="container-fluid barreDeRecherche">
                                        <form class="d-flex">
                                            <input class="form-control me-2 tailleBarre" type="search" placeholder="rechercher un jour" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit"><span class="motRechercher">rechercher</span></button>
                                        </form>
                                    </div>
                                </nav>
                            </li>
                            <hr>
                            <li>
                                <nav class="navbar navbar-light">
                                    <div class="container-fluid barreDeRecherche">
                                        <form class="d-flex">
                                            <input class="form-control me-2 tailleBarre" type="search" placeholder="rechercher un tag" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit"><span class="motRechercher">rechercher</span></button>
                                        </form>
                                    </div>
                                </nav>
                            </li>
                        </ul>
                        <p>recherche populaire</p>
                        <a href="#" class="badge badge-dark">Dark</a>
                        <a href="#" class="badge badge-dark">Dark</a>
                        <a href="#" class="badge badge-dark">Dark</a>
                        <a href="#" class="badge badge-dark">Dark</a>
                        <a href="#" class="badge badge-dark">Dark</a>
                        <a href="#" class="badge badge-dark">Dark</a>
                    </div>
                </div>
            </nav>

            <div class="col-lg-8 col-md-9 col-sm-9 centre">

                <!-- bannière date -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>samedi 4 janvier 2021</h2>
                    </div>
                </div>
                <hr />

                <div class="row ligneCard">

                    <!-- box evenement -->
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card boxEvenemt">
                            <a href="https://www.ugc.fr/cinema.html?id=51#"><img src="img/cinema.jpg" class="card-img-top" alt="..."></a>

                            <div class="card-body">
                                <p class="card-text">salle de cinema blablabla blablabl blablabl blablabl</p>
                            </div>
                        </div>
                    </div>



                </div>


            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 coteDroit">
            <div class="menuCoterDroite">

                <button class="open-button" onclick="openForm()" class="btn btn-primary"><strong>connexion</strong></button>
            </div>
            <div class="login-popup">
                <div class="form-popup" id="popupForm">
                    <form action="/action_page.php" class="form-container">
                        <h2>Veuillez vous connecter</h2>
                        <label for="email">
                            <strong>E-mail</strong>
                        </label>
                        <input type="text" id="email" placeholder="Votre Email" name="email" required>
                        <label for="psw">
                            <strong>Mot de passe</strong>
                        </label>
                        <input type="password" id="psw" placeholder="Votre Mot de passe" name="psw" required>
                        <button type="submit" class="btn">Connecter</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
                    </form>
                </div>
            </div>
            <script>
                function openForm() {
                    document.getElementById("popupForm").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("popupForm").style.display = "none";
                }
            </script>

            <a href="../form_event/form_event.html" class="btn btn-secondary bouton">S'inscrire</a>
            <a href="../page-orga/page-orga.html" class="btn btn-secondary bouton">Mon compte</a>
        </div>
        <div class="card boxOrga">

            <img src="img/orga.jpg" class="card-img-top imgDroite" alt="...">

            <p class="card-titre">nom organisation</p>
        </div>
        <div class="card boxOrga">

            <img src="img/orga.jpg" class="card-img-top imgDroite" alt="...">

            <p class="card-titre">nom organisation</p>
        </div>
        <div class="card boxOrga">

            <img src="img/orga.jpg" class="card-img-top imgDroite" alt="...">

            <p class="card-titre">nom organisation</p>
        </div>
    </div>

<?php
}
