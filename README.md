# symfony-maraicher
Test technique pour CDS Institue

## installation locale
Clonez le dépôt git puis lancer un ```composer install``` pour installer les dépendances.

Quelques dépendances supplémentaires :
```
composer require symfony/mailer
composer require ext-pdo
composer require symfony/dotenv
```

## base de données
Vous trouverez ci-joint le fichier de la base de données MySQL. Importez-le dans votre SGBD puis modifier votre variable
d'environnement selon le schéma suivant : ```mysql://USERNAME:PASSWORD@SERVER:PORT/maraicher```

