# Glinche Véhicules

## Installation
(prérequis : PHP 8.2+, Composer, Node 20+)

### Back
cd backend && composer install && cp .env.example .env
php artisan migrate
(renseigner les identifiants de l'API Glinche dans .env)
Pour lancer Laravel :
```php artisan serve```

### Front
Pour lancer Vue.js :
```cd frontend && npm install && npm run dev```

## Choix techniques
- Laravel sert de proxy : les identifiants API ne sortent jamais côté client
- Sync en base (SQLite) : filtre rapide, marques construites depuis les données, l'app marche même si l'API est down
- Vue 3 + composable `useVehicles` pour séparer la logique de l'affichage

## Difficultés rencontrées
- Difficulté avec le filtrage des marques dû à une utilisation compliqué de l'API
- Problème de configuration Laravel (Problème de certificat SSL)

## Si j'avais eu plus de temps
- Landing page
- Marketplace plus agréable et moins agressif pour les yeux
- Filtres supplémentaires (énergie, prix, km)
- Tests automatisés, Docker
