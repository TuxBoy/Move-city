# Move-city

Contribution au site Move-city de drazozo.

## Installation

```bash
$ git clone https://github.com/TuxBoy/Move-city.git
$ cd Move-city
```

* Installer les dépendances avec composer :

```bash
$ composer install
```

* Lancer le serveur interne de PHP :

```bash
$ php -S localhost:8080 -t public/ -ddisplay_errors=1
```

* Se rendre sur http://localhost:8080

## Configuration

### Base de donnée MySQL
La configuration de la base de données se fait dans le fichier loc.php qui se situe à la racine du projet
Le fichier est créer automatiquement à la première consultation du site, en se basant sur le loc.blank.php.
