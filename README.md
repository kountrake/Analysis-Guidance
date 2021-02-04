# <u>Projet Analyse Fonctionnelle</u>



## Table des matières

[TOC]



## Installation et pré-requis

### GIT

Pour récupérer le projet, il vous est possible de le faire via ssh:

```git
git clone git@gitlab-etu.fil.univ-lille1.fr:s6-projet/projet.git
```

ou via http:

```git
git clone https://gitlab-etu.fil.univ-lille1.fr/s6-projet/projet.git
```

ou encore de le télécharger directement sur ce [lien](https://gitlab-etu.fil.univ-lille1.fr/s6-projet/projet).

### Composer

Lorsque vous récupérez le projet, il vous faut premièrement avoir composer d'installer sur votre machine. Il vous suffit de suivre les instructions disponibles sur le site de [composer](https://getcomposer.org/download/).

Puis, il faut vous placer à la racine du projet et entrez la commande:

```composer
composer install
```

Cette commande va se charger d'installer toutes les dépendances relatives au projet.

## Le projet

### Les routes

Les routes permettent de définir les pages de l'application et d'y associer différentes fonctions.

Chaque route se compose :

- D'un nom permettant d'identifier une route
- D'un chemin correspondant à celui dans l'url
- D'un controller et d'une fonction permettant de gérer la page qui est appelé

Exemple d'une route:

```php
$maroute = new Route('dashboard_index', '/dashboard', 'DashboardController@index')
```

#### Les méthodes

##### Les Getters

La classe route possède les Getters nécessaire pour accéder à chacune des propriétés:

- getName()
- getPath()
- getAction()

##### La méthode matches

Cette méthode compare le chemin de la route à celui passé en paramètre et retourne un booléen, vrai si les chemins sont égaux, faux sinon. 

```php
$maroute->matches(string $path); //return bool
```

##### La méthode execute

Execute permet de lancer dans le controller la  méthode. Par exemple, elle lancera dans le DashboardController la fonction index qui permet l'affichage de la vue.

```php
$maroute->execute();
```



### Le router

Le router est composé d'un tableau de tableau. La première dimension regroupe les différentes méthodes alors que le deuxième dimension regroupe les routes associées à une méthode.

```php
$monRouter = new Router();
```



#### Les méthodes

##### Les getters

Deux getters sont présents dans la classe router. Le premier correspond au getter pour avoir le tableau contenant toues les routes.

```php
$monRouter->getRoutes()
```

Le deuxième permet de récupérer une route précise par son nom.

```php
$monRouter->getRoute($name)
```

##### La méthode addRoute

Cette méthode permet d'ajouter une route dans le tableau. La route est ajouter dans le sous tableau correspond à une méthode précise (GET, POST, UPDATE, DELETE)

```php
$monRouter->addRoute('GET', 'dashboard_index', '/dashboard', 'DashboardController@index')
```

Il n'est cependant pas possible d'ajouter une route qui porte le même nom qu'une route déjà présente dans le router. Cela lève une exception!

##### La méthode match

Cherche si la route existe et dans le cas où elle existe retourne la route, sinon renvoie une route vers une erreur 404

```php
$monRouter->match($path, $method)
```



### Les controllers

Les controllers permettent de gérer les pages en incluant les fonctions appelées par les routes. On peut donc imaginer un controller pour la page de connexion (LoginController). A l'intérieur de ce controller on va retrouver tout d'abord une méthode permettant d'envoyer la vue de la page de connexion. Ainsi qu'une autre méthode permettant à une route en POST de récupérer les informations et de les comparer à celles de la BDD et  soit de rediriger vers la page pour utilisateur authentifié soit rester sur la page de connexion en incluant les erreurs.

```php
class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }
}
```



### RegisterValidator

Cette classe permet de tester différents informations récupérées depuis un formulaire d'inscription et permet de les valider si elles suivent les critères fixés.

- isValidName()
- isValidEmail()
- isValidPassword()