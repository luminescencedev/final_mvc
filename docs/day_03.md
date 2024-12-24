# Composer
Composer est un outil de gestion de dépendances pour un projet PHP.
Il permet d'installer et de gérer des librairies sur lesquelles un projet dépend.

## Librairie
Une librairie (ou une bibliothèque) sont des ensembles de fonctions/méthodes/classes que les développeurs peuvent utiliser pour accomplir des tâches courantes sans avoir à réécrire le code. Une librairie peut par exemple faciliter l'envoi de mail, manipuler des images, intéragir avec une base de données, ...

## Dépendance
Lorsqu'un projet dépend d'une librairie pour fonctionner, on dit qu'il "dépend" de cette librairie. Cette librairie devient alors une dépendance du projet.
Par exemple, si vous developpez un site en PHP qui utilise une librairie pour gérer l'authentification des utilisateurs, cette libraire qui gère l'authentification devient alors une dépendance au projet.

## Gestionnaire
Un gestionnaire ou gestionnaire de dépendances est un outil exactement comme composer.
Un gestionnaire de dépendances permet aux développeurs d'indiquer quelles librairies leur projet nécessite et s'assure que ces librairies sont installés et mise à jour sur le projet.

## composer.json
Chaque projet qui utilise Composer a un fichier 'composer.json' qui liste toutes les dépendances du projet.

## .gitignore
Le fichier .gitignore c'est tout simplement un fichier ou on va mettre tous les dossier/fichier qu'on ne veut pas push sur le repo git distant.

## Ajouter une dépendance vie fichier composer.json
Pour ajouter une dépendance direvtement sur le fichier .json on ajoute dans le `"require:"` le nom et la version de la librairie qu'on veut installer.
Pour installer AltoRouter, on fait comme ça :
```js
{
    "require": {
        "symfony/var-dumper": "^5.4",
        "altorouter/altorouter": "1.1.0"
    }
}
```
Ensuite on va executer la commande :
- composer install => si aucun dossier vendor existant dans la racine du projet
- composer update => si dossier vendor deja existant dans la racine du projet

## Installer une dépendance directement en ligne de commande avec composer
Pour installer une dépendance en ligne de commande avec composer, on fait :
```bash
composer require nom_de_la_dependance
```
Par exemple pour installer var-dumper :
```bash
composer require symfony/var-dumper
```
ATTENTION : le nom de la dépendance ne se devine pas => il faut voir la doc de la librairie pour voir ce qu'il faut taper. ( doc de var-dumper : https://symfony.com/doc/current/components/var_dumper.html)

## Autoload.php
C'est le fichier que je vais devoir inclure pour utiliser toutes mes dépendances composer(donc les librairies installés dans mon dossier vendor).
Pour l'inclure :
```php
// Ici j'inclus le fichier autoload.php car c'est grâce à ce fichier que je vais pouvoir inclure TOUTES mes dépendances composer (donc ce qu'il y a dans le dossier vendor)
require_once __DIR__ . "/../vendor/autoload.php";
```