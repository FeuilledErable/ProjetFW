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