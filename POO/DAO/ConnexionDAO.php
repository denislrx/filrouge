<?php



class ConnexionDAO
{
    protected function connexion()
    {
        $bdd = new mysqli("localhost", "root", "", "agenda");
        return $bdd;
    }
}
