# Projet micro-service
 ***

## Description

Les documents annexes sont disponibles dans le dossier ANNEXE :
- MCD (Modèle Conceptuel de Données).
- Description de l'API.
 ***


## Récupération du projet

```
$ git clone https://github.com/Pierrechami/micro_services.git
```
 ***

## Installation

```
# Installation des dépendances
composer install

# Création de la base de données
php bin/console doctrine:database:create

# Création du fichier de migrations
php bin/console make:migration
 
# Création des tables en base de données
php bin/console doctrine:migrations:migrate

# Insertions des jeux de données (fixtures)
php bin/console doctrine:fixtures:load --no-interaction
```
 ***

## Utilisation

Deux options pour lancer le serveur de développement PHP :

* Si vous avez installé _Symfony_
```
symfony server:start
```

* Si vous utilisez _Composer_, il faut installer le Web Server Bundle :
```
composer require symfony/web-server-bundle --dev
php bin/console server:start
```





