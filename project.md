Contexte du projet
Vous travaillez pour DigitalBite Agency, une agence spécialisée dans la création d'applications pour l'industrie culinaire. Votre client, Marrakech Food Lovers, souhaite créer une plateforme permettant aux passionnés de cuisine de partager et organiser leurs recettes préférées.

Le Problème : Actuellement, les recettes sont dispersées dans des cahiers papier, des photos sur téléphone et des fichiers Word. Il est impossible de les retrouver facilement ou de les partager avec la communauté.

En tant que développeur Backend, votre rôle est de :

Architecturer le flux MVC : Isoler les responsabilités. Interdire au "Cuisinier" (Modèle) de manipuler la "Salle à Manger" (Vue) et orchestrer la circulation des données via un "Serveur" (Contrôleur) sans compromis.
Blinder la POO par l'Encapsulation : Verrouiller l'accès aux données avec des propriétés private. Standardiser l'interaction avec les objets via des méthodes public (Getters/Setters) pour garantir la sécurité et la maintenabilité du code.
Structurer l'Ingénierie de Données SQL : Modéliser et déployer des relations One-to-Many (1-N). Assurer l'intégrité référentielle entre les Utilisateurs, les Recettes et les Catégories en configurant des clés étrangères (Foreign Keys).
Piloter l'Agilité Opérationnelle : Adopter la méthodologie Kanban. Découper les besoins business en User Stories actionnables sur Jira et synchroniser votre binôme lors des Daily Standups pour éliminer les bloqueurs en temps réel.
Concevoir via la Méthode Merise : Produire une analyse structurelle complète avant toute phase de développement :
MCD (Modèle Conceptuel de Données) : Identifier les Entités, définir les Associations et calculer les Cardinalités.
MLD (Modèle Logique de Données) : Traduire le schéma conceptuel en structure technique SQL exploitable.
User Stories (Besoins Business)
US1 (Inscription Utilisateur) : En tant que visiteur, je veux créer un compte (username, email, password) pour pouvoir ensuite gérer mes recettes.
US2 (Connexion Utilisateur) : En tant qu'utilisateur enregistré, je veux me connecter avec mon email et mot de passe pour accéder à mon espace personnel.
US3 (Afficher Mes Recettes) : En tant qu'utilisateur connecté, je veux voir la liste de toutes mes recettes avec leur titre, temps de préparation et date de création.
US4 (Créer une Recette) : En tant qu'utilisateur connecté, je veux ajouter une nouvelle recette avec tous ses détails (titre, ingrédients, instructions, temps, portions).
US5 (Modifier une Recette) : En tant qu'utilisateur connecté, je veux modifier une de mes recettes existantes.
US6 (Supprimer une Recette) : En tant qu'utilisateur connecté, je veux supprimer une recette que j'ai créée.
US7 (Catégories de Recettes) : En tant qu'utilisateur, je veux organiser mes recettes par catégories (Entrées, Plats, Desserts, Boissons) pour mieux les retrouver.
US8 (Filtrer par Catégorie) : En tant qu'utilisateur, je veux filtrer mes recettes par catégorie pour voir uniquement mes desserts ou mes plats principaux.
++ Bonus (Choisir UNE extension par binôme)
Recherche de Recettes : Ajouter une barre de recherche qui filtre les recettes par titre ou ingrédients.
Recettes Favorites : Permettre à un utilisateur de marquer des recettes comme "favorites".
Temps Total Automatique : Afficher le temps total (prep + cuisson) et badge "recette rapide" (<30 min).
Notes/Évaluations : Permettre aux utilisateurs de noter leurs recettes sur 5 étoiles.
------------------------------------------------------------------------------------------------------

Sanction : Tout code "magique" non maîtrisé lors de la revue de code entraînera l'invalidation de la User Story correspondante.
Modalités pédagogiques
Mode : Binômes (Pairs)
Durée : 5 jours
Date de lancement : Lundi 06/04/2026 – 09:45 AM
Deadline : Vendredi 10/04/2026 – 17:00 PM
Modalités d'évaluation
Entretien binôme de 30 minutes composé de :
Démonstration (10 min) : Parcours utilisateur complet (Inscription → Connexion → Création recette → Catégories → Filtrage → Bonus). Présentation du board Jira.

Code Review (10 min) : Un membre du binôme explique :

Le fonctionnement du RecipeController
Le flux complet d'une requête MVC
La gestion des relations SQL (Foreign Keys, JOINs)
La séparation des responsabilités (Model vs Controller vs View)

Live Coding (10 min) : Modification en direct (ex: "Ajoutez un champ 'difficulty' à une recette et affichez-le", "Empêchez un utilisateur de modifier la recette d'un autre").
Questions Process (2-3 min) : Organisation Jira, gestion du binôme, résolution de problèmes.
Livrables
1. Repository GitHub :

Minimum 12 commits explicites reflétant l'évolution
Exemples : Add User registration controller, Implement Recipe CRUD in Model, Add Category filtering
Les deux membres doivent avoir des commits à leur nom

2. Fichier SQL :

Script complet de création des tables
Seeding avec minimum 3 utilisateurs, 10 recettes, 4 catégories

3. README.md :

Description du projet
Diagramme Entités-Relations (photo papier ou draw.io)
Screenshot du board Jira/Trello final
Arborescence du projet (structure MVC)
Instructions d'installation
Critères de performance
Séparation MVC : Aucune requête SQL dans les vues, logique métier dans les Models.
Encapsulation POO : Utilisation correcte des visibilités (private/public) dans les classes.
Sécurité : Prepared Statements (PDO), password_hash(), validation stricte des formulaires.
Relations SQL : Foreign Keys correctes, JOINs fonctionnels.
Collaboration : Les deux membres peuvent expliquer l'intégralité du code.
Process Agile : Board Jira utilisé, Daily Standups effectués, Retrospective complétée.
Propreté : Indentation parfaite, nommage cohérent, commits clairs.