# Environnements

[Retour au sommaire](index.md)

Pré-requis :
* PHP >= 7.4
* MySQL >= 5.7

Il existe plusieurs environnements différents :
* `dev`: environnement de développement
* `test`: environnement de test

Pour chaque environnement, il sera nécessaire de créer un fichier contenant les variables d'environnement.

## Environnement de développement
Exemple du fichier `.env.dev.local`.
```dotenv
# Nécessaire si vous souhaitez faire fonctionner les tests systèmes
DATABASE_URL="mysql://appmodule:appmodule@appmodule-iutlr-info2-dw-mysql:3306/db-appmodule?serverVersion=13&charset=utf8"
```

*Si vous utilisez wamp, saisissez cette variable d'environnement : *
```dotenv
DATABASE_URL="mysql://root:@localhost:3306/appModules?serverVersion=13&charset=utf8"
```

## Environnement de test
Il est indispensable de créer le fichier `.env.test.local` pour assurer le bon fonctionnement des tests, vous pouvez vous baser sur cet exemple :
```dotenv
# Nécessaire si vous souhaitez faire fonctionner les tests systèmes
DATABASE_URL="mysql://appmodule:appmodule@appmodule-iutlr-info2-dw-mysql:3306/db-appmodule?serverVersion=13&charset=utf8"
```

*Si vous utilisez wamp, saisissez cette variable d'environnement : *
```dotenv
DATABASE_URL="mysql://root:@localhost:3306/appModules?serverVersion=13&charset=utf8"
```

Il est préférable d'insérer les variables d'environnement dans la configuration du virutalhost en production.