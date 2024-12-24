# Gros recap

## index.php
le FrontController c'est la ou on créer nos routes, on redirige les routes vers Controller puis method etc

## Dossier Controller
c'est la ou on va mettre en place les actions qui vont s'effectuer a chaque route
Par ex si on créer une route /liste/users et qu'avec AltoRouter on dit que la méthode list du controller UserController doit s'executer alors list() de UserController doit s'executer

## Les Models
c'est la qu'on fait nos requetes vers la bdd, c'est une classe PHP qui va contenir des propriétés qui auront le meme nom que les colonnes de la table de la bdd. Pour acceder a ces propriétés, on va utiliser des getter et setter.

## Pour avoir le dossier vendor + le fichier composer.json executer :
```bash
composer init
```
Puis taper entrer jusqu'a la fin

## composer.json 
dedans il y aura toutes les bibliotheque necessaire pour le fonctionnement ud projet. Par exemple pour installer altorouter on ajoute dans composer.json :
```js
"require": {
        "altorouter/altorouter": "1.1.0"
    }
```
Puis on execute dans le terminal a la racine du projet :
```bash
composer install
```
Recap kourou : https://kourou.oclock.io/ressources/fiche-recap/composer/