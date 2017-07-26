<?php

namespace Shop;

use AltoRouter;

class FrontController
{
  // Méthode statique (voir fiche récap php POO)
  public static function run()
  {

    // Charger la config : (parse_ini_file = appli plus sécurisée => la config n'est plus en variable globale)
    $config = parse_ini_file('config.conf');

    // var_dump($config);

    // Configuration des routes :
    $routes = array(
        // map homepage

        /* ('méthode',
            'url',
            'cible de la route' = au lieu d'être une fonction, on mets le nom du controller et la méthode que l'on veut appeler,
            'nom de la route')*/
        array('GET', '/', 'ShopController#home', 'home'),
        array('GET', '/product/[i:id]', 'ShopController#product', 'product-detail'),
        array('GET', '/admin', 'AdminController#dashboard', 'admin-dashboard'),
    );

    // FrontController :
    // Créer le router
    $router = new AltoRouter();

    // Il configure le router (base_path & mapping : la liste des routes)
    $router->setBasePath($config['BASE_PATH']);
    $router->addRoutes($routes);

    // Initialiser le moteur de templates
    // $templates = ;

    // Il lance le matching du router (renvoie target, params et name)
    // Match current request url
    $match = $router->match();

    // Il fait le dispatch
    // call closure or throw 404 status
    if($match) {
        // get controller & fonction name from $match['target']
        /* $parts = tableau avec 2 cases :
            case 1 : contient le nom du controller qu'on veut éxécuter
            case 2 : contient le nom de la méthode qu'on veut éxécuter */
        $parts = explode('#', $match['target']);
        // $parts = explode('#', 'ShopController#home');

        /* $parts = [
                0 => "ShopController"
                1 => "home"
            ] */

        // Récupère le nom de la class du controller qu'on veut utiliser
        $ctrlClass = 'Shop\\Controller\\' . $parts[0];

        // Instancier le controller souhaité
        $controller = new $ctrlClass($router, $config, $templates);

        // Récupère le nom de la méthode souhaitée
        $methodName = $parts[1];

        // extract = transforme $match['params'] en un id (valeur demandée)
        $controller->$methodName(extract($match['params']));

    } else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
  }
}

?>
