# 🍽️ Marrakech Food Lovers — Recipe Platform

> **DigitalBite Agency** · PHP MVC · Binôme · 5 jours

| | |
|---|---|
| 🚀 **Lancement** | Lundi 06/04/2026 — 09h45 |
| ⏰ **Deadline** | Vendredi 10/04/2026 — 17h00 |
| 👥 **Mode** | Binômes (pairs) |
| 🎤 **Évaluation** | Entretien oral de 30 minutes |

---

## 📌 Contexte & problème

Les recettes sont actuellement dispersées dans des cahiers papier, des photos sur téléphone et des fichiers Word. Il est **impossible de les retrouver facilement ou de les partager** avec la communauté.

**Solution :** Une plateforme web MVC permettant aux passionnés de cuisine de créer, organiser, filtrer et partager leurs recettes.

---

## 🎯 User Stories

| ID | Rôle | Besoin | Critère d'acceptation |
|----|------|--------|----------------------|
| **US1** | Visiteur | Créer un compte (username, email, password) | Compte créé, password hashé, redirection vers login |
| **US2** | Utilisateur enregistré | Se connecter avec email + mot de passe | Session démarrée, accès au dashboard |
| **US3** | Utilisateur connecté | Voir la liste de mes recettes | Affiche titre, temps de préparation, date de création |
| **US4** | Utilisateur connecté | Ajouter une recette (titre, ingrédients, instructions, temps, portions) | Recette sauvegardée en BDD, visible dans la liste |
| **US5** | Utilisateur connecté | Modifier une de mes recettes | Formulaire pré-rempli, mise à jour en BDD |
| **US6** | Utilisateur connecté | Supprimer une recette que j'ai créée | Confirmation, suppression, recette disparaît de la liste |
| **US7** | Utilisateur | Organiser mes recettes par catégorie (Entrées, Plats, Desserts, Boissons) | Catégorie assignée à la création/modification |
| **US8** | Utilisateur | Filtrer mes recettes par catégorie | Affiche uniquement les recettes de la catégorie choisie |

### ⭐ Bonus (choisir 1 par binôme)

- 🔍 **Recherche** — barre de recherche filtrant par titre ou ingrédients
- ❤️ **Favoris** — marquer des recettes comme favorites
- ⏱️ **Temps total automatique** — afficher prep + cuisson, badge "recette rapide" (< 30 min)
- ⭐ **Notes/Évaluations** — noter ses recettes sur 5 étoiles

---

## 🗓️ Milestones & Répartition des tâches

> **Dev A** = priorité Models / Controllers / Backend logic  
> **Dev B** = priorité Views / Frontend + SQL schema / Seeding

---

### Milestone 1 — Setup & Architecture · *Jour 1 (Lundi)*

| Assigné | Tâche | Type |
|---------|-------|------|
| **Dev A** | Initialiser le repo GitHub, définir la stratégie de branches (main/dev/feature), écrire la structure README | `setup` |
| **Dev B** | Créer le board Jira Kanban, rédiger tous les tickets US avec descriptions et critères d'acceptation | `process` |
| **Dev A** | Mettre en place la structure MVC : `/models` `/controllers` `/views` `/config` `/public` | `backend` |
| **Dev B** | Dessiner le MCD (entités, associations, cardinalités) sur papier ou draw.io | `SQL` |
| **Dev A** | Configurer la classe de connexion PDO avec gestion d'erreurs dans `/config/Database.php` | `backend` |
| **Dev B** | Traduire MCD → MLD, écrire le script SQL complet avec FK et contraintes | `SQL` |
| **Dev A** | Configurer `.htaccess` router et `index.php` comme front controller | `backend` |
| **Dev B** | Exécuter le script SQL, seeder 4 catégories, 3 utilisateurs, données de test | `SQL` |

✅ **Sync fin de journée :** repo cloné par les deux, BDD opérationnelle, MCD validé

---

### Milestone 2 — Authentification · *Jour 2 (Mardi)* · US1 & US2

| Assigné | Tâche | Type |
|---------|-------|------|
| **Dev A** | Créer la classe `User` (propriétés `private`, getters/setters, `findByEmail()`, `create()` via PDO) | `backend` |
| **Dev B** | Construire la vue d'inscription : formulaire username/email/password avec hints de validation | `frontend` |
| **Dev A** | Implémenter `UserController::register()` — valider, `password_hash()`, insérer via le modèle, rediriger | `backend` |
| **Dev B** | Construire la vue de login : formulaire email/password, zone de message d'erreur, layout partagé | `frontend` |
| **Dev A** | Implémenter `UserController::login()` — vérifier, `password_verify()`, démarrer session, rediriger | `backend` |
| **Dev B** | Créer le middleware auth : helper `isLoggedIn()`, rediriger les non-connectés des pages protégées | `backend` |
| **Dev A** | Ajouter la route logout + `session_destroy()`, tester le flux complet end-to-end | `backend` |
| **Dev B** | Styliser les pages auth (formulaires, états d'erreur), déplacer les tickets Jira sur "Done" | `frontend` |

✅ **Sync fin de journée :** inscription → connexion → déconnexion fonctionnel, session sécurisée

---

### Milestone 3 — CRUD Recettes · *Jour 3 (Mercredi)* · US3, US4, US5, US6

| Assigné | Tâche | Type |
|---------|-------|------|
| **Dev A** | Créer la classe `Recipe` : propriétés `private`, getters/setters, `getByUser()`, `getById()`, `create()` via PDO | `backend` |
| **Dev B** | Construire la vue liste de recettes (US3) : tableau/cards avec titre, temps de prépa, date, boutons d'action | `frontend` |
| **Dev A** | Implémenter `RecipeController::index()` — récupérer les recettes via le modèle, passer à la vue (pas de SQL dans la vue !) | `backend` |
| **Dev B** | Construire le formulaire de création (US4) : tous les champs (titre, ingrédients, instructions, prep_time, cook_time, portions) | `frontend` |
| **Dev A** | Implémenter `RecipeController::create()` et `store()` — valider, appeler `Recipe::create()`, rediriger avec flash | `backend` |
| **Dev B** | Construire le formulaire d'édition (US5) : formulaire pré-rempli avec les valeurs actuelles | `frontend` |
| **Dev A** | Implémenter `RecipeController::edit()` et `update()` — **vérifier l'ownership** : `user_id === $_SESSION['user_id']` | `backend` |
| **Dev B** | Implémenter la suppression (US6) : confirmation dans la vue, `RecipeController::delete()` avec vérification d'ownership | `backend` |

✅ **Sync fin de journée :** CRUD complet testé, protection d'ownership vérifiée, 8+ commits

---

### Milestone 4 — Catégories, Filtrage & Bonus · *Jour 4 (Jeudi)* · US7, US8, Bonus

| Assigné | Tâche | Type |
|---------|-------|------|
| **Dev A** | Créer le modèle `Category` : `getAll()`, `getById()` — vérifier que les 4 catégories sont seedées | `backend` |
| **Dev B** | Ajouter la colonne `category_id` FK à la table `recipes`, mettre à jour le modèle Recipe et les requêtes SQL | `SQL` |
| **Dev A** | Mettre à jour les formulaires create/edit pour inclure un dropdown catégorie (peuplé dynamiquement depuis la BDD) | `frontend` |
| **Dev B** | Implémenter `RecipeController::filterByCategory()` — paramètre GET `?category_id=X`, requête JOIN dans le modèle | `backend` |
| **Dev A** | Construire l'UI de filtrage : onglets ou select sur la page liste, highlight du filtre actif | `frontend` |
| **Dev B** | Implémenter le bonus choisi — partie modèle/contrôleur | `backend` |
| **Dev A** | Implémenter le bonus choisi — partie vue/frontend | `frontend` |
| **Dev B** | Ajouter un JOIN à la requête liste pour afficher le nom de la catégorie avec chaque recette | `SQL` |

✅ **Sync fin de journée :** toutes les US + bonus fonctionnels, board Jira quasi-complet

---

### Milestone 5 — Polish, Seeding & Préparation orale · *Jour 5 (Vendredi)*

| Assigné | Tâche | Type |
|---------|-------|------|
| **Dev A** | Rédiger le README complet : description, arborescence MVC, photo du diagramme ER, instructions d'installation | `doc` |
| **Dev B** | Finaliser le script SQL de seed : 3 users, 10 recettes variées, 4 catégories — tester une installation propre | `SQL` |
| **Dev A** | Audit sécurité : vérifier que tous les inputs utilisent des prepared statements, aucun SQL brut avec données utilisateur | `backend` |
| **Dev B** | Screenshot du board Jira final, ajouter au README, fermer tous les tickets complétés | `process` |
| **Dev A** | Nettoyage du code : indentation cohérente, nommage uniforme, supprimer les `var_dump`, vérifier 12+ commits | `quality` |
| **Dev B** | Répéter la code review : expliquer `RecipeController`, le flux MVC complet, la logique FK/JOIN | `prep` |
| **Dev A** | Répéter le live coding : pratiquer "ajouter un champ difficulty" et "bloquer l'édition d'une recette d'un autre user" | `prep` |
| **Dev B** | Push final sur GitHub, vérifier que les deux membres ont des commits, confirmer que le repo est accessible | `delivery` |

🏁 **Deadline : Vendredi 10/04/2026 à 17h00**

---

## 🗃️ Schéma SQL

### Tables

```sql
-- Table users
CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)  NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table categories
CREATE TABLE categories (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(50) NOT NULL
);

-- Table recipes
CREATE TABLE recipes (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    category_id  INT,
    title        VARCHAR(100) NOT NULL,
    ingredients  TEXT NOT NULL,
    instructions TEXT NOT NULL,
    prep_time    INT,                  -- en minutes
    cook_time    INT,                  -- en minutes
    portions     INT,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)     REFERENCES users(id)      ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

### Relations

```
users (1) ──────────────── (N) recipes      →  recipes.user_id → users.id
categories (1) ─────────── (N) recipes      →  recipes.category_id → categories.id
```

### Seed minimal

```sql
INSERT INTO categories (name) VALUES ('Entrées'), ('Plats'), ('Desserts'), ('Boissons');

INSERT INTO users (username, email, password) VALUES
  ('fatima',  'fatima@test.com',  '$2y$10$...'),  -- password hashé
  ('youssef', 'youssef@test.com', '$2y$10$...'),
  ('leila',   'leila@test.com',   '$2y$10$...');

-- Minimum 10 recettes réparties sur les 3 users et 4 catégories
```

---

## 📋 Kanban Jira — Tickets à créer

Copier ces IDs et noms directement dans Jira. Tous les tickets démarrent en **To Do**.

| Ticket | Titre | Assigné | Priorité | Type |
|--------|-------|---------|----------|------|
| MFL-01 | GitHub repo + stratégie de branches | Dev A | 🔴 Haute | setup |
| MFL-02 | Jira Kanban + tous les tickets US | Dev B | 🔴 Haute | process |
| MFL-03 | Structure MVC des dossiers | Dev A | 🔴 Haute | backend |
| MFL-04 | MCD — entités & cardinalités | Dev B | 🔴 Haute | SQL |
| MFL-05 | Classe de connexion PDO | Dev A | 🔴 Haute | backend |
| MFL-06 | Script SQL + contraintes FK | Dev B | 🔴 Haute | SQL |
| MFL-07 | Modèle User (propriétés private, PDO) | Dev A | 🔴 Haute | backend |
| MFL-08 | Vue inscription + formulaire | Dev B | 🔴 Haute | frontend |
| MFL-09 | UserController::register() | Dev A | 🔴 Haute | backend |
| MFL-10 | Vue login + layout partagé | Dev B | 🔴 Haute | frontend |
| MFL-11 | UserController::login() + session | Dev A | 🔴 Haute | backend |
| MFL-12 | Auth guard + logout | Dev B | 🟡 Moyenne | backend |
| MFL-13 | Modèle Recipe (méthodes CRUD) | Dev A | 🔴 Haute | backend |
| MFL-14 | Vue liste de recettes | Dev B | 🔴 Haute | frontend |
| MFL-15 | RecipeController::index() + store() | Dev A | 🔴 Haute | backend |
| MFL-16 | Formulaires create/edit recette | Dev B | 🔴 Haute | frontend |
| MFL-17 | RecipeController::update() + ownership | Dev A | 🔴 Haute | backend |
| MFL-18 | Suppression + vérification ownership | Dev B | 🔴 Haute | backend |
| MFL-19 | Modèle Category + FK dans recipes | Dev A | 🟡 Moyenne | SQL |
| MFL-20 | Dropdown catégorie + JOIN | Dev B | 🟡 Moyenne | SQL |
| MFL-21 | UI filtrage catégories + contrôleur | Dev A | 🟡 Moyenne | frontend |
| MFL-22 | Fonctionnalité bonus (complète) | Dev A + B | 🟢 Basse | bonus |
| MFL-23 | README + photo diagramme ER | Dev A | 🟡 Moyenne | doc |
| MFL-24 | SQL seed — 3 users / 10 recettes | Dev B | 🟡 Moyenne | SQL |
| MFL-25 | Audit sécurité (injections SQL, hash) | Dev A | 🔴 Haute | backend |
| MFL-26 | Push final + screenshot Jira | Dev B | 🔴 Haute | delivery |

---

## 📦 Livrables

### 1. Repository GitHub
- [ ] Minimum **12 commits explicites** reflétant l'évolution
- [ ] Les **deux membres ont des commits** à leur nom
- [ ] Messages de commit clairs (ex: `Add UserController`, `Implement Recipe CRUD in Model`)

Exemples de bons commits :
```
Add User registration controller
Implement Recipe CRUD in Model
Add Category filtering with JOIN
Fix ownership check in RecipeController
Seed database with 3 users and 10 recipes
```

### 2. Fichier SQL (`database.sql`)
- [ ] Script complet de création des tables (DROP IF EXISTS inclus)
- [ ] Déclarations des Foreign Keys
- [ ] Seed : 3 utilisateurs, 10 recettes, 4 catégories
- [ ] S'exécute proprement depuis zéro en une seule commande

### 3. README.md
- [ ] Description du projet
- [ ] Diagramme Entités-Relations (photo papier ou draw.io)
- [ ] Screenshot du board Jira final
- [ ] Arborescence MVC du projet
- [ ] Instructions d'installation étape par étape

---

## 🏗️ Architecture MVC attendue

```
project/
├── config/
│   └── Database.php          ← Connexion PDO
├── controllers/
│   ├── UserController.php    ← register(), login(), logout()
│   └── RecipeController.php  ← index(), create(), store(), edit(), update(), delete()
├── models/
│   ├── User.php              ← private props, getters/setters, findByEmail(), create()
│   ├── Recipe.php            ← private props, getByUser(), getById(), create(), update(), delete()
│   └── Category.php          ← getAll(), getById()
├── views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── auth/
│   │   ├── register.php
│   │   └── login.php
│   └── recipes/
│       ├── index.php
│       ├── create.php
│       └── edit.php
├── public/
│   └── css/style.php
├── .htaccess                 ← Routage vers index.php
└── index.php                 ← Front controller
```

> ⚠️ **Règle absolue :** aucune requête SQL dans les vues. Toute la logique métier reste dans les Models.

---

## ✅ Critères de performance

| Critère | Exigence |
|---------|----------|
| **Séparation MVC** | Aucune requête SQL dans les vues, logique métier dans les Models |
| **Encapsulation POO** | Utilisation correcte de `private`/`public` dans toutes les classes |
| **Sécurité** | PDO Prepared Statements, `password_hash()`, validation stricte des formulaires |
| **Relations SQL** | Foreign Keys correctes, JOINs fonctionnels |
| **Collaboration** | Les deux membres peuvent expliquer l'intégralité du code |
| **Process Agile** | Board Jira utilisé, Daily Standups effectués, Rétrospective complétée |
| **Propreté** | Indentation parfaite, nommage cohérent, commits clairs |

---

## 🎤 Préparation à l'entretien oral (30 min)

### Démonstration (10 min)
Parcours complet : **Inscription → Connexion → Création recette → Catégories → Filtrage → Bonus**  
Présenter le board Jira.

### Code Review (10 min)
Un membre du binôme doit être capable d'expliquer :
- Le fonctionnement du `RecipeController`
- Le flux complet d'une requête MVC (request → controller → model → view)
- La gestion des relations SQL (Foreign Keys, JOINs)
- La séparation des responsabilités (Model vs Controller vs View)

### Live Coding (10 min)
Exemples de scénarios probables :
- *"Ajoutez un champ `difficulty` à une recette et affichez-le"*
- *"Empêchez un utilisateur de modifier la recette d'un autre"*

### Questions Process (2-3 min)
Organisation Jira, gestion du binôme, résolution de problèmes.

---

> ⚠️ **Sanction :** Tout code "magique" non maîtrisé lors de la revue de code entraînera l'**invalidation de la User Story** correspondante.
