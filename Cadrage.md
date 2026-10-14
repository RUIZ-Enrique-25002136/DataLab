# Cadrage du projet — Application web d'apprentissage des bases de données relationnelles

## 1. Rôles utilisateurs

- Au moins trois rôles : **enseignant**, **étudiant**, **administrateur**.
- Un utilisateur peut cumuler plusieurs rôles, mais n'en utilise **qu'un seul à la fois**, avec possibilité de basculer de l'un à l'autre (comme sur AMeTICE).

## 2. Organisation pédagogique

- Gestion des **cours**, **promos**, **groupes de TD** et **groupes de TP**.
- Relation **N-N** entre cours et promos.
- Inscription des étudiants via leur **mail universitaire** (AMU dans un premier temps, à rendre générique).

## 3. Gestion des bases de données

### 3.1 Bases de référence et copies de travail

- L'enseignant peut déposer des **bases de référence en lecture seule**.
- Enseignants comme étudiants peuvent se créer **une ou plusieurs copies de travail**.
- Possibilité de **se resynchroniser** avec la base de référence en cas de problème.

### 3.2 Partage et association aux cours

- Partage d'une base **par lien** ou **par ajout** de personnes (comme sur Amubox).
- Relation **N-N** entre bases et cours : plusieurs bases par cours, une base dans plusieurs cours.

### 3.3 SGBD supportés

- **PostgreSQL**, **MySQL**, **SQLite**.
- Le SGBD est **choisi par l'enseignant** au moment du partage d'une base.
- Les **URL des SGBD** sont renseignées par chaque utilisateur dans son profil.
- Les **noms des bases sont imposés par l'enseignant**, pour garantir l'interopérabilité.

## 4. Fonctionnalités par rôle

### 4.1 Tous les utilisateurs

- **Exploration** d'une base : visualisation du schéma et des données.
- **Requêtage** d'une base, avec affichage et visualisation des résultats.

### 4.2 Enseignants

- **Création et configuration** de bases.
- **Monitoring des étudiants** par promo, groupe de TD, groupe de TP ou individuellement :
  - dans un premier temps, statistiques d'usage **quantitatives** (fréquence, ratio requêtes en erreur / sans erreur, etc.) ;
  - le **qualitatif** viendra plus tard (cf. perspectives).

### 4.3 Administrateurs

- **Création des profils enseignants** et **modération**.
- **Gestion des bases** en vue d'ensemble.

## 5. Fonctionnalités back-end

- **Authentification**.
- **Orchestration et abstraction** entre les différents SGBD.
- **Collecte des traces d'usage**.

## 6. Exigences transverses

- **Interface** moderne, agréable, lisible et fluide : elle doit donner envie de l'utiliser.
- **Déploiement** : anticiper tôt les prérequis pour un déploiement réaliste, au moins pour les TP de bases de données de l'IUT Informatique d'Aix.
- **Positionnement par rapport à l'existant (état de l'art) :** identifier et étudier des outils existants similaires, commenter les fonctionnalités communes et différences avec application en cours de développement, repérer de nouvelles perspectives par transposition/amélioration d'éléments existants ailleurs ou pour répondre à des besoins non couverts par l'existant.

## 7. Questions ouvertes

- Pertinence d'un **mode SQL** et d'un **mode PL/SQL** séparés pour le requêtage ?
- Quel ensemble de **statistiques d'usage** retenir pour le monitoring (fréquence, ratio erreurs / sans erreur, etc.) ?

## 8. Perspectives

### 8.1 Nouvelles fonctionnalités pédagogiques

- **Mode exercice** (dérivé du mode requêtage) : un énoncé, éventuellement une vérification de la réponse et des indices en cas de difficulté. Implique deux volets :
  - **création** d'exercices côté enseignant ;
  - **réalisation** d'exercices côté étudiant.
- **Requêtage en mode « LEGO »**, inspiré de Scratch.
- **Visualisation en temps réel des effets des opérateurs SQL** (transformation en direct d'une table jouet).

### 8.2 Suivi pédagogique avancé

- **Monitoring qualitatif** de la progression et des erreurs des étudiants.

### 8.3 Gamification

- Badges / *achievements* à collectionner.
- Système de **quêtes** pour s'entraîner.
