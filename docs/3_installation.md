# Installation

[Retour au sommaire](index.md)

## Récupérer les sources du projet
```
git clone https://forge.iut-larochelle.fr/llebrun/2020-2021-info2-pts-konji_kondo.git
```

## Pré-requis

* PHP 7.4
* Composer
* Symfony CLI
* Docker & Docker-compose OU WAMP

Vous pouvez vérifier les pré-requis (sauf Docker et Docker-compose) avec la commande suivante (de la CLI Symfony) :

```
symfony check:requirements
```

## Installer les dépendances

Dans un premier temps, positionnez vous dans le dossier du projet :
```
cd 2020-2021-info2-pts-konji_kondo
```

### Lancer l'environnement de développement
**Pré-requis :** lancez l'application Docker si ce n'est pas déjà le cas.

Construisez et démarrez les conteneurs du projet :
```
docker-composer up --build
```

*Si vous utilisez wamp, lancez simplement l'application et exécutez ces commandes :*
```
cd appmodule
symfony serve
```

### Installer les bundles

Démarrez un terminal dans le conteneur associé à notre service symfony :
```
docker exec -it appmodule-iutlr-info2-dw-api-symfony bash
```
Normalement, le bash s'ouvre dans le dossier `/var/html/www`.

Dans ce terminal associé à notre service symfony, positionnez-vous dans le répertoire appmodule :
```
cd appmodule
```

Mettez à jour le vendor :
```
composer install
```

*Si vous utilisez wamp, exécutez seulement cette commande :*
```
composer install
```

## Mettre en place la connexion à la base de donnée

Vous allez maintenant configurer le `.env.local` pour accéder à la base de données de notre projet.

Dans le ficher "docker-compose.yml", nous avons mis la configuration suivante :
```
mysql:
   environment:
     MYSQL_DATABASE: db-appmodule
     MYSQL_USER: appmodule
     MYSQL_PASSWORD: appmodule
     MYSQL_ROOT_PASSWORD: appmodule
```

Dans ce cas, l'URL JDBC pour se connecter à cette base de données à partir du projet Symfony (fichier `.env.local`) est :
```
DATABASE_URL="mysql://appmodule:appmodule@appmodule-iutlr-info2-dw-mysql:3306/db-appmodule?serverVersion=13&charset=utf8"
```

Ainsi, créez le fichier `.env.local` et collez-y cette ligne:
```
DATABASE_URL="mysql://appmodule:appmodule@appmodule-iutlr-info2-dw-mysql:3306/db-appmodule?serverVersion=13&charset=utf8"
```

*Si vous utilisez wamp, saisissez cette variable d'environnement : *
```dotenv
DATABASE_URL="mysql://root:@localhost:3306/appModules?serverVersion=13&charset=utf8"
```

## Initialiser la base de données

**Pré-requis :** votre bash est ouvert dans le dossier `/var/html/www/appmodule`. Si ce n'est pas le cas, exécutez ces commandes :
```
docker exec -it appmodule-iutlr-info2-dw-api-symfony bash
cd appmodule
```

Mettre en place le schéma de la base de données :
```
composer prepare
```

Ajouter des données factices à la base de données :
```
php bin/console doctrine:fixtures:load -n
```

## Accéder à l'application

Vous pouvez maintenant accéder à l'application : [http://localhost:9998/AppModules](http://localhost:9998/AppModules)

## Pour aller plus loin : lancer des tests

Vous allez maintenant configurer le `.env.test.local` pour accéder à la base de données de notre projet depuis les tests.

Créez le fichier `.env.test.local` et collez-y cette ligne:
```
DATABASE_URL="mysql://appmodule:appmodule@appmodule-iutlr-info2-dw-mysql:3306/db-appmodule?serverVersion=13&charset=utf8"
```

*Si vous utilisez wamp, saisissez cette variable d'environnement : *
```dotenv
DATABASE_URL="mysql://root:@localhost:3306/appModules?serverVersion=13&charset=utf8"
```

Puis, lancez la compilation des fichiers tests :
```
php bin/phpunit
```

## Traitement des erreurs
### L'erreur survient au démarrage de la stack docker
```
docker-compose up --build
```
Si la commande ci-dessus affiche des erreurs, lire les instructions suivantes attentivement.

#### Vérifiez si vous êtes bien situé dans le répertoire de ce projet
Dans le terminal, exécuter cette commande :
```
pwd
```
Si le nom du répertoire (`2020-2021-info2-pts-konji_kondo`) n'est pas mentionné tout au bout de la chaîne, se replacer dans le bon répertoire.

Une fois bien replacé, effectuez le démarrage de la stack.
```
docker-compose up --build
```

Si une erreur persiste, continuer la lecture.

#### Vérifiez qu'il n'y a pas de conteneurs docker démarrés

Pour voir les processus docker qui tournent :
```
docker ps -a
```

Pour arrêter les conteneurs démarrés :
```
docker stop $(docker ps -a -q)
```

Pour supprimer tous les conteneurs, pour éviter des conflits de nommage :
```
docker rm $(docker ps -a -q)
```
Attention: ces deux commandes peuvent envoyer une erreur argument manquant s'il n'y a pas de conteneurs qui tournent. C'est normal car **docker ps -a -q** ne renvoit rien.

Réeffectuez le démarrage de la stack :
```
docker-compose up --build
```

Si une erreur persiste, continuer la lecture.

#### L'erreur peut venir du répertoire `mysql`

Le processus de mysql n'a pas été lancé correctement.

Pour voir les processus docker qui tournent :
```
docker ps -a
```

Si le processus `iutlr-info2-dw-mysql` a un statut `exited`, supprimez le répertoire `mysql` depuis la racine du projet:
```
rm -Rf mysql
```

Réeffectuez le démarrage de la stack :
```
docker-compose up --build
```

