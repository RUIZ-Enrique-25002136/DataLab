Au moins trois rôles : enseignant, étudiant, administrateur. Toujours un rôle à la fois, mais possibilité d'en avoir plusieurs attribués pour passer d'un mode à un autre (comme sur AMeTICE).

L'enseignant peut déposer des bases de données de référence en lecture seule. Il peut se créer une ou des copies de travail. Idem pour les étudiants (possibilité de se resynchroniser en cas de problème). Possibilité de partager la base par lien ou par ajout (comme sur Amubox).

Gestion de cours, promos, groupes TD, groupes TP. Inscription des étudiants avec leur mail universitaire (amu, à rendre générique).

SGBD supportés : Postgresql, Mysql, sqlite. Choisi par l'enseignant au moment du partage d'une base. Les URL vers les SGBD devront être renseignés par chaque utilisateur dans leur profil. Noms des bases imposés par l'enseignant pour interopérabilité.

Plusieurs bases peuvent être associées à un cours, et une base peut être associée à plusieurs cours. Lien N-N aussi pour cours-promo.

Principales fonctionnalités de base du site :

- Accessibles à tous :
  
  * Exploration d'une base / visualisations du schéma et des données.
  - Requêtage d'une base et affichage + visualisation des résultats.
    
    - A re-réfléchir : pertinence d'un mode SQL et d'un mode PL/SQL séparés ?

- Accessible aux enseignants :
  
  - Création et configuration d'une base.
  
  - Monitoring des étudiants par promo, TD, TP ou individuellement, avec dans un premier temps statistiques d'usage (quantitatif, qualitatif plus tard).
    
    - Identifier un ensemble de statistiques intéressantes : fréquence, ratio erreurs/pas erreurs, etc.

- Accessible aux administrateurs :
  
  - Création de profils enseignants et modération.
  
  - Gestion en vue d'ensemble des bases.

Fonctionnalités de back :

- Authentification.

- Orchestration et abstraction entre SGBD.

- Collecte de traces d'usage.



Interface moderne, agréable, lisible, fluide => doit donner en vie de l'utiliser.

Anticiper tôt les prérequis pour un déploiement réaliste, au moins pour les TP de bases de données de l'IUT INFO AIX.



Perspectives :

- Nouvelles fonctionnalités pédagogiques :
  
  - Mode exercice (dérivé du mode requêtage), avec un énoncé et éventuellement vérifications réponse + indices en cas de difficultés. Implique un aspect création d'exercice (côté enseignant) et réalisation d'exercice (côté étudiant).
  
  - Requêtage en mode LEGO inspiré du Scratch.
  
  - Visualisation en temps réel des effets des opérateurs SQL (transformation en temps réel d'une table jouet).

- Monitoring qualitatif de la progression et des erreurs des étudiants.

- Gamification : badges/achievements à collectionner, système de quêtes pour s'entraîner, etc.


