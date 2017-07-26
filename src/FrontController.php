<?php

namespace Shop;

class FrontController
{
  // Méthode statique (voir fiche récap php POO)
  public static function run()
  {
    echo "execution de notre appli: on lance le frontcontroller";

    // Charger la config : (parse_ini_file = appli plus sécurisée => la config n'est plus en variable globale)
    $config = parse_ini_file('config.conf');

    // FrontController
    // Il configure le router (la liste des routes)
    // Il lance le matching du routeur
    // Il fait le dispatch
  }
}

?>
