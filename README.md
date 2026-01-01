# Mise en place du projet

## Prérequis

### les logiciels suivants doivent êtres installés :

- nodejs 
- npm 
- php
- xampp
- git

## Installation de la base de données

- récupérer le fichier de chemin `docs/database/Commandes.sql`

- lancer xampp, démarer mysql, ouvrir, le terminal et copier le contenu du fichier Commandes.sql

## lancement de l'application

- cloner le repository `git clone https://github.com/AnessFOUKA/mini_mvc.git`

- accéder au dossier du repository cloné et installer les dépendances : 
- - `npm install --save-dev`(effectuer la commande dans le dossier frontend)
- - `composer install`(effectuer la commande à la racine du dossier du repository cloné)

- lancer l'application 
- - `npm run dev`(pour le frontend, dans le dossier frontend)
- - `php -S localhost:8080 -t public`(pour l'api, à la racine du dossier du repository cloné)

## identifiants test pour se connecter

- adresse email : client1@example.com

- mot_de_passe : motdepasse1