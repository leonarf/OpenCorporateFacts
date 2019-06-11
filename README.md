# OpenCorporateFacts
Ceci est le code source d'un site web proposant différents formulaire pour remplir une base de données sur les information financière publiques des entreprises françaises.
Le site web permet aussi d'explorer les données sous forme de graphique, de graphe et de les télécharger en open data.

# Developper welcome
The project use the PHP framework Symfony, and some javascript library to render graphs and graphic.
The database is the classic fork of mysql : mariadb

# How to install and run locally
On a linux distro :
  * install mariadb-server
  * `systemctl start mariadb.service` pour démarrer le service
  * `systemctl enable mariadb.service` pour que le service démarre automatiquement au boot
  * install symfony4
  * install php-mysql
  * install composer
  * clone the git repo
  * `composer install` in the local git repo pour installer des trucs symfony
  * `composer require symfony/orm-pack` pour installer l'ORM doctrine
  * `composer require symfony/maker-bundle --dev` pour installer l'ORM doctrine aussi
  * `composer req api` pour installer l'API REST
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
