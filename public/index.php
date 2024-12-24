<?php

// Ici j'inclus le fichier autoload.php car c'est grâce à ce fichier que je vais pouvoir inclure TOUTES mes dépendances composer (donc ce qu'il y a dans le dossier vendor)
require_once __DIR__ . "/../vendor/autoload.php";

use App\Controllers\CatalogController;
use App\Controllers\MainController;

// Je créer une instance de AltoRouter (la librairie que j'ai installé)
$router = new AltoRouter();

// On fournit à AltoRouter la partie de l'URL à ne pa sprendre en compte pour faire la comparaison entre l'URL courante et l'url de la route
// LA valeur de $_SERVER['BASE_URI'] est donnée par le fichier .htaccess. Elle correspond au chemin de la racine du site, ici se termine par public
$router->setBasePath($_SERVER['BASE_URI']); // Je définis le chemin de base => ce par quoi mes routes vont commencer (localhost/.../public)

// Ici, je créer mes routes (https://altorouter.com/usage/mapping-routes.html)

// Ci dessous je dump(j'affiche) CatalogController::class
// CatalogController::class => c'est le nom complet de la classe CatalogController, cad que ca va afficher le namespace de cette classe + le nom de la classe => App\Controllers\CatalogController
$router->addRoutes(array( 
    array('GET','/', [
        'controller' => MainController::class, // Dans quel controller ?
        'action' => 'home' // Quelle méthode dans ce controller ?
    ], 'home'),
    array('GET','/mentions-legales', [
        'controller' => MainController::class, // le namespace nom de la classe + le nom de la classe (concatenation) 
        'action' => 'legalMentions'
    ], 'legal-mentions'),
    array('GET','/catalogue/categorie/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'category'
    ], 'catalog-category'),
    array('GET','/catalogue/type/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'type'
    ], 'catalog-type'),
    array('GET','/catalogue/marque/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'brand'
    ], 'catalog-brand'),
    array('GET','/catalogue/produit/[i:id]', [
        'controller' => CatalogController::class,
        'action' => 'product'
    ], 'catalog-product'),
    array('GET','/test', [
        'controller' => MainController::class,
        'action' => 'test'
    ])
  ));

// Ici on check si la route sur laquelle on est a bien été mappé
// doc : https://altorouter.com/usage/matching-requests.html
// La valeur de retour de $router->match() sera egal a false si la route vers laquelle on fait une requete http n'existe pas (n'a pas été routé)
// Elle sera egale a un tableau associatif avec 3 clé target, params et name si la route existe
$match = $router->match();
// dump($match);

// Pour vérifier si la route existe bien
if ($match != false) { // Ici je verifie si $match n'est pas = false
    // On rentre dans le if que si la route existe bel et bien
    // Ci dessous je stock dans $controllerToUse le nom du controller dont j'ai besoin pour la route demandée
    $controllerToUse = $match['target']['controller']; // Le nom du controller
    $methodToUse = $match['target']['action']; // Le nom de la méthode
    // Maintenant qu'on a récupéré le nom de la methode ainsi que le nom du controller, on va devoir executer la méthode qui est dans le controller
    // Pour se faire, on va devoir créer une instance du controller
    $controller = new $controllerToUse(); // $controller est une instance de la classe souhaité (par exemple MainController)
    // Maintenant on va executer la methode $methodToUse
    // J'execute la methode $methodToUse() en lui passant le parametre $match['params'].
    // $match['params'] => array assoc qui contient toutes les données que je veux passer.
    $controller->$methodToUse($match['params']);
}
