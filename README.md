# chat-apps-php-frameworkless
Implement Chat using MVC &amp; POO without framework . PHP /MYSQL/ HTML

# CONF
- PHP 7.4.11
- Mysql 5.6

# LINKS
- Database : un fichier sql est présent à la racine du projet: frameworkless_chat.sql
- user account password: secret 

# PROCEDURE D'INSTALLATION
- Télécharger le projet depuis le repository
- Ajuster les informations de configuration dans le fichier .env.php
- Creer manuellement une base de donnée à partir des information définie dans le fichier de configuration .env.php du projet
- Le projet ne contient pas de composer files  et autres bibliotheques externe. Tout est fait manuellement : autoloader, router, .env.php ..
- Une fois la base de donnée créer, démarrer le server interne de php comme suit  : php -S localhost:8887 -t public/
- Des le 1er édmarrage, 2 tables [messages, users] sont crées automatiquement ainsi que 4 comptes utilisateurs. Un message s'affichera pour vous le signifier.
- Une autre possibilité est de vous servir du zip et d'importer la base de donnée fournie
- Utilisez l'un des comptes creer pour connecter au backoffice Ex : hanane@gmail.fr . Ou créer simplement un compte depuis l'application.


# ETAT D'AVANCEMENT 
- Authentifcation
- Sécurité : (securité d code , restrict access page, password encrypted..)
- Liste des utlisateurs connectés
- Creation automatique des tables de base de donnée
- Création automatique des comptes utilisateurs.
- Creation automatique des messages (conversation)