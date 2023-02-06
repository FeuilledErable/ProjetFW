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
