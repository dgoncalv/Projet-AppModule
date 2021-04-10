# Mise en production

[Retour au sommaire](index.md)

## Importer le code sur l'hébergeur

### Manuellement

Il est possible de copier les fichiers manuellement vie FTP/SCP.

### Git CD

## Installer les dépendances

```
composer install --no-dev --optimize-autoloader
```

## Mise en place des tables

Il est possible d'exécuter les migrations pour avoir une application qui contient des données.

```
php bin/console doctrine:migrations:migrate
```

## Nettoyer le cache

```
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear
```

## Besoin d'aide ?
* https://symfony.com/doc/current/deployment.html