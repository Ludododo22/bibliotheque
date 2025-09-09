# 📚 Bibliothèque en Ligne

Projet réalisé dans le cadre du cours **Développement Web (niveau intermédiaire)**.  
Ce site permet de gérer une bibliothèque en ligne avec recherche, détails de livres, liste de lecture personnelle et interface administrateur.  

---

## 🎯 Objectifs
- Rechercher des livres par **titre** ou **auteur**
- Consulter les détails d’un livre
- Ajouter / retirer des livres dans une **liste de lecture**
- Gérer les livres via une interface **administrateur (CRUD)**

---

## 🛠️ Technologies utilisées
- **Frontend** : HTML, CSS (Flexbox & Grid), JavaScript
- **Backend** : PHP 8
- **Base de données** : MySQL (via phpMyAdmin)
- **Serveur local** : XAMPP (Apache + MySQL)

---

## ⚙️ Installation

### 1. Prérequis
- [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MySQL)
- Navigateur moderne (Chrome, Firefox, Edge)

### 2. Étapes
1. Cloner le projet :
   ```bash
   git clone https://github.com/TON-UTILISATEUR/bibliotheque-web.git


Déplacer le dossier dans htdocs :

C:\xampp\htdocs\bibliotheque


Créer une base bibliotheque via http://localhost/phpmyadmin

Importer le fichier bibliotheque.sql

3. Configuration

Le fichier config.php
 contient les paramètres de connexion MySQL :

$DB_HOST = 'localhost';
$DB_NAME = 'bibliotheque';
$DB_USER = 'root';
$DB_PASS = '';

🌐 Utilisation

Accéder au site : http://localhost/bibliotheque

📌 Pages principales :

index.php → Accueil (recherche + nouveautés)

resultats.php → Résultats de recherche

details.php → Détails d’un livre + ajout liste

favoris.php → Liste de lecture

gerer.php → Interface admin (CRUD des livres)


🔮 Améliorations possibles

Pagination des résultats

Authentification lecteurs

Redimensionnement automatique des images

Filtres avancés (par auteur, maison d’édition…)

✍️ Auteur

Projet réalisé par ATOMO Ludovic
📅 Session Juillet 2025 — Dclic2025
