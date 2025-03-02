# FullDive VR - Plateforme de Réalité Virtuelle

## Description
FullDive VR est une plateforme de réalité virtuelle permettant aux utilisateurs d'explorer différents mondes virtuels inspirés d'univers populaires comme One Piece, Naruto, Dragon Ball, etc. Les utilisateurs peuvent acheter des packs d'accès et des mondes individuels via un système de panier intégré.

## Prérequis
- PHP 8.1 ou supérieur
- Composer
- Symfony CLI
- MySQL/MariaDB
- Node.js et npm

## Installation

### 1. Cloner le projet
```bash
git clone [URL_DU_REPO]
cd fulldive-vr
```

### 2. Installer les dépendances
```bash
composer install
npm install
```

### 3. Configuration de l'environnement
- Copier le fichier `.env.example` en `.env.local`
```bash
cp .env.example .env.local
```
- Modifier les variables d'environnement dans `.env.local` :
  - Configurer la connexion à la base de données
  - Définir l'APP_SECRET
  - Configurer les autres paramètres si nécessaire

### 4. Créer la base de données
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Charger les fixtures (données de démonstration)
```bash
php bin/console doctrine:fixtures:load
```

### 6. Compiler les assets
```bash
npm run build
```

### 7. Démarrer le serveur
```bash
symfony server:start
```

## Fonctionnalités

### Système de Packs
- Pack Standard
- Pack Premium
- Pack VIP

### Mondes Virtuels Disponibles
- One Piece - Grand Line
- Naruto - Konoha
- Dragon Ball - Super Terre
- My Hero Academia - UA Academy
- Sword Art Online - Alfheim
- Violet Evergarden - Service Postal

### Système de Panier
- Ajout/Suppression de produits
- Compteur de produits
- Notifications d'actions
- Calcul automatique du total

## Structure du Projet

### Controllers Principaux
- `HomeController.php` : Gestion de la page d'accueil
- `CartController.php` : Gestion du panier
- `WorldController.php` : Gestion des mondes virtuels

### Templates
- `templates/home/index.html.twig` : Page d'accueil
- `templates/cart/index.html.twig` : Page du panier
- `templates/base.html.twig` : Template de base

### Assets
- `public/css/` : Fichiers CSS
- `public/js/` : Fichiers JavaScript
- `public/uploads/worlds/` : Images des mondes

## Utilisation

### Navigation
1. Accédez à la page d'accueil
2. Explorez les différents packs et mondes disponibles
3. Ajoutez des produits au panier
4. Consultez et gérez votre panier

### Gestion du Panier
- Cliquez sur "Ajouter au panier" pour un produit
- Accédez au panier via l'icône en haut à droite
- Supprimez des produits si nécessaire
- Procédez au checkout

## Contribution
1. Fork le projet
2. Créez une branche pour votre fonctionnalité
3. Committez vos changements
4. Push sur la branche
5. Créez une Pull Request

## Sécurité
- Ne jamais commiter le fichier `.env`
- Utiliser `.env.local` pour les configurations locales
- Suivre les bonnes pratiques de sécurité Symfony

## Support
Pour toute question ou problème, veuillez ouvrir une issue dans le repository.

## Licence
Ce projet est sous licence [Votre Licence]. 