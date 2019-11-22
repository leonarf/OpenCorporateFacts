# OpenCorporateFacts
Ceci est le code source d'un site web proposant une interface pour explorer, télécharger et contribuer à une base de données contenant les informations financière publiquement diffusées des entreprises française.

## Structure du repos Git
### Le dossier `data`
Le but du dossier `data` est de contenir les codes et les fichiers nécessaires au traitement massif de données. 

Ce dossier contient actuellement : 1) le csv `CodeEtSignification.csv` , 2) le script python `xmlToCsv.py` qui permet le traitement des données provenant du FTP de l'INPI : 

 - Récupération des données depuis le FTP : 
     - Parcours de l'arborescence du FTP ;
     - Téléchargement d'un fichier .zip en vu de le traiter ;
     - Extraction du fichier .zip et parcours de son contenu ;
     
 - Lecture des fichiers .xml contenant les données de bilans comptables : 
     - Parcours du fichier .xml ;
     - Traduction en langage humain des codes administratifs trouvés ;
     - Création d'objets python (dictionnaire) contenant les codes et leurs valeurs ;
     
 - Utilisation des données lues : 
     - Écriture des données sur la base OCF via l'API REST ;
     - Si le serveur n'accepte pas les données après avoir fait ses vérifications, création d'un fichier .csv contenant les données.

### Les autres dossiers sont l'arborescence classique d'un projet Symfony 4
#### Le dossier `template` 
Le dossier `template` contient le code client/frontend/html/css/JavaScript sous la forme de fichier .twig. Ces fichiers sont utilisés par les *controller* pour construire la page associée à l'URL demandée par le navigateur.

#### Le dossier `src` 
Le dossier `src` contient l'ensemble du code serveur/php/backend.

Dans `src/Entity`, il y a un fichier par *entité*, c'est-à-dire par type d'objet sauvegardé en base. Les *entity* sont les suivantes : 
- les entreprises (fichier `Corporate.php`) ; 
- les bilans comptables (fichier `CompteDeResultat.php`) ; 
- les liens capitalistiques entre entreprises (fichier `ShareHolding.php`).

Ces fichiers sont en grande partie générés via l'ORM Doctrine qui fait le lien entre les entités et la base de données.

Dans `src/Controller`, il y a un fichier *controller* par *entité* ou page web. Les *controller* sont en charge de donner les bonnes informations au template correspondant à l'URL demandée par l'utilisateur.

### Base de données
La base de données est maintenue via Doctrine (plugin Symfony), qui permet de généré le code php des *entités* et les scripts de migration du dossier `src/Migrations` qui assurent la cohérence du schéma de la base.

> **Lien vers le site de Symfony : https://symfony.com/**

# Developper welcome
The project use the PHP framework Symfony, and some javascript library to render graphs and graphic.
The database is the classic fork of mysql : mariadb.

# How to install and run locally
On a linux distro :
  * install mariadb-server
  * `systemctl start mariadb.service` pour démarrer le service
  * `systemctl enable mariadb.service` pour que le service démarre automatiquement au boot
  * install symfony4
  * install php-mysql
  * install composer
  * install yarn (https://yarnpkg.com/lang/en/docs/install)
  * clone the git repo
  * `composer install` in the local git repo pour installer des trucs symfony
  * `php bin/console assets:install --symlink public` pour générer les truc de FOSJsRoutingBundle permettant de faire du routing dans le javascript
  * `bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json` pour générer plus de truc de FOSJsRoutingBundle
  * `yarn install` pour préparer le framework front vuejs
  * `yarn encore dev` toujours pour préparer symfony a utiliser un framework frontend via webpack
  * `composer require symfony/orm-pack` pour installer l'ORM doctrine
  * `composer require symfony/maker-bundle --dev` pour installer l'ORM doctrine aussi
  * `composer require api` pour installer l'API REST
  * `composer require symfony/serializer-pack` pour pouvoir exporter des données en csv
  * `composer require symfony/webpack-encore-bundle` pour pouvoir utiliser des framework front comme vuejs
  * `mysql_secure_installation` pour définir le mot de passe root de mariadb, dire Yes à tout le reste
  * définir dans le fichier .env les information de connection à la base pour doctrine
  * `php bin/console doctrine:database:create` pour créer la base de donnée
  * `php bin/console doctrine:migrations:migrate` pour créer les tables dans la base
  * `php bin/console server:run` pour lancer le serveur
  * go to http://127.0.0.1:8000/ with your favourite browser (firefox)

# How to load sample database locally
On a linux distro :
  * install phpMyAdmin
  * run `systemctl restart httpd.service`
  * go to http://localhost/phpmyadmin/ with your favourite browser (firefox)
  * Select the database
  * Import the file databaseBackupSample.sql

# How to install on a fedora server
## Update fedora
dnf install dnf-plugin-system-upgrade
dnf system-upgrade download --refresh --releasever=
dnf system-upgrade reboot
## install step more or less
dnf install mariadb php-symfony4 php-mysqlnd git httpd unzip mariadb-server php
systemctl start httpd.service
systemctl enable httpd.service
setsebool -P httpd_unified 1
setsebool -P httpd_can_network_connect_db 1
