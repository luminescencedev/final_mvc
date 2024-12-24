# MVC

## M : Model

- Représente la couche de données de l'application et contient la logique métier, les données et les règles de gestion.
- Le modèle est responsable de la gestion, de la manipulation et de la persistance des données, ainsi que de la définition des comportements métier de l'application.

## V : Views

- Tout ou partie d'une page. Contient des affichages, PAS DU TOUT de traitements.
- On préférera créer les variables en dehors des vues, faire des calculs en dehors également etc...
- Par contre on peut appeler des conditions ou des boucles sans soucis dans une vue.

## C : Controllers

- Classe qui va regrouper l'algo et la logique de notre contenu.
- C'est un peu le chef d'orchestre du MVC.

## Routes

- Renseignées dans l'URL, elles permettent d'orienter sur quel code exécuter à quel moment. (Par exemple la route '/store' nous permet d'appeler la bonne méthode pour afficher la bonne page en récupérant les bonnes informations)
- Les routes définissent les actions à exécuter

## .htaccess

- Dans un fichier .htaccess on donne des instructions (directives) à notre logiciel serveur (=> chez nous Apache)
- On a activé la réécriture d'url grâce au .htaccess disponible à la racine du projet
- On a également empêché les accès externes aux dossiers views et controllers grâce aux .htaccess disponibles à la racine des dossiers views et controllers

### Explication .htaccess de rewriting

- `RewriteEngine On` - Active le moteur de réécriture d'Apache.

- `RewriteCond %{REQUEST_URI}::$1 ^(/.+)/(.*)::\2$` - Capture l'URI de base et la partie relative de l'URI demandée.

- `RewriteRule ^(.*) - [E=BASE_URI:%1]` - Définit une variable d'environnement BASE_URI avec l'URI de base capturée.

- `RewriteCond %{REQUEST_FILENAME} !-d` - Vérifie que l'URL demandée ne correspond pas à un répertoire.

- `RewriteCond %{REQUEST_FILENAME} !-f` - Vérifie que l'URL demandée ne correspond pas à un fichier.

- `RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]` - Redirige les requêtes non correspondantes vers index.php avec l'URL relative comme paramètre GET _url.