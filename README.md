# Question 1

- KOUKOUGNON Lehion
- MBANGANA ENGONGOLO Rebeca
- PROUST Olivia
- TERTEREAU Rhayan

## Comment créer un projet Symfony vide
```bash
docker-compose build
docker-compose up -d
docker exec -ti my-good-container bash
symfony new projet_FW --webapp
cd projet_FW/
symfony server:start --no-tls --d
```

## Comment mettre en place Webpack encore et Bootstrap

```bash
symfony composer require symfony/webpack-encore-bundle
npm install
npm install bootstrap
npm run dev
```

# Question 2

## Comment créer l’entité Atelier, la base de données et la table associée à cette entité
```bash
symfony console doctrine:database:create
symfony console make:entity Atelier
symfony console make:migration
symfony console doctrine:migrations:migrate
```

# Question 3

## Installer Faker
```bash
symfony composer require fakerphp/faker
```

## Créer sa fixture et l'executer
```bash
symfony composer require orm-fixtures --dev
symfony console make:fixture
symfony console doctrine:fixtures:load
```

# Question 4

## Créer un CRUD pour gérer les ateliers
```bash
symfony console make:crud Atelier
```

# Question 5 

## Création de la barre de navigation à l'aide de Bootstrap. 
   ```
   Ajout de design afin d'embellir l'application. 
   ```

# Question 6

## Markdown description
```bash
symfony composer require cebe/markdown
```

# Question 7

## User et authentification
```bash
symfony console make:user
symfony console make:migration
symfony console doctrine:migrations:migrate
symfony console make:entity User
symfony console make:auth
symfony console make:registration-form
```

# Question 8

## Relation User Atelier
```bash
symfony console make:entity Atelier
```

# Question 9

## Restriction creation d'un atelier
```
Creation d'atelier uniquement possible par un instructeur connecté
```

# Question 10

## Contraintes pertinentes
```
Button edit et delete accessible que par un instructeur
```

# Question 11

## Embellissement
```
Mise en forme des formulaires, edit, ..
Barre de navigation mise à jour.
```

# Question 12

## Relation ManyToMany Atelier User

```bash
symfony console make:user
```

# Question 13
 ```bash
symfony console make:controller profile
 ```

# Question 14

```
Traduction des dernières parties en anglais. 
Bouton préventir pour se desinscrire d'un atelier
Signalement des cours suivis ou des cours créés sur la liste des ateliers.
```

# Question 15

## Admin

```bash
symfony console make:crud User
```

# Question 16

## Separation ?

```
on a rajouté au fur et à mesure des contraintes...
```

# Question 17

## Notation

```bash
symfony console make:entity Note
symfony console make:form
```