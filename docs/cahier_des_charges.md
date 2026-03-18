# Chier des charges - MoneyBrain

## 1. Présentation du projet
Objectif de MoneyBrain et de faciliter le processus d'économie en répondant à quelques questions.
Ce projet est lancé suite à l'utilisation régulière d'Excel pour des objectifs économiques, ce qui n'est pas toujours simple à utiliser et à visualiser.
Le format de MoneyBrain sera une web app sans marketplace ou monétisation. 

## 2. Objectifs
- Faciliter la définition d'un objectif d'épargne (montant + date cible).
- Calculer automatiquement le montant d'épargne mensuel nécessaire. 
- Vérifier si l'objectifs est compatible avec le budget mensuel de l'utilisateur (l'utilisateur voit un message clair : 'Oui c'est possible' ou 'Non, ajuste ton objectif ou ton budget').
- Remplacer un tableau Excel manuel par une interface guidée.

## 3. Utilisateurs cibles
Etudiants, jeunes actifs, personnes qui veulent bien gérer leur épargne.
Pas forcément experts finance, mais à l'aise avec un site web.

Niveau tech : utilise un navigateur PC ou mobile

## 4. Parcours utilisateur
1. Page d’accueil  
   - Bouton “Start Economie” qui amène à la configuration.

2. Objectif d’épargne  
   - Champ : montant total à économiser.

3. Date de début  
   - Date à laquelle l’utilisateur souhaite commencer.  
   - Si la date est passée : on demande l’épargne déjà réalisée.

4. Date de fin  
   - Date à laquelle l’utilisateur souhaite atteindre son objectif.

5. Récapitulatif des paramètres  
   - L’utilisateur voit : objectif, dates, durée, épargne déjà réalisée.  
   - Bouton pour confirmer et continuer.

6. Entrées du mois  
   - L’utilisateur saisit ses revenus mensuels du mois actuel.  
   - Possibilité de modifier les entrées (édition simple).

7. Sorties du mois  
   - L’utilisateur saisit ses dépenses mensuelles du mois actuel.  
   - Possibilité de modifier les sorties (édition simple).

8. Budget “Plaisir”  
   - L’utilisateur définit combien il veut garder comme “argent de poche”.

9. Calcul de la faisabilité  
   - L’app compare :  
     - Épargne mensuelle nécessaire (objectif / durée)  
     - vs. ce qui reste après : entrées – sorties – budget plaisir.  
   - Si non possible : page “problème” avec message explicite + liens vers les paramètres à ajuster (objectif, dates, budget plaisir, etc.).

10. Accès au dashboard  
    - Vue récapitulative (graphiques, état de l’objectif, évolution de l’épargne, etc.).  
    - Fonctionnalité prévue pour une version ultérieure (v2).

## 5. Fonctionnalités principales
- Core (v1 – MVP)
  - Page d’accueil avec bouton “Start Economie”
  - Capture de l’objectif (montant + date de fin)
  - Gestion de la date de début et épargne déjà réalisée
  - Gestion de la daye de fin
  - Saisie des entrées mensuelles
  - Saisie des sorties mensuelles
  - Définition du budget plaisir
  - Calcul de faisabilité (message “possible / non possible”)
  - Navigation étape par étape (wizard)

- Dashboard (v2)
    - Vue récapitulative de l’objectif et de l’évolution de l’épargne.  
    - Graphiques ou indicateurs simples (à ajouter ultérieurement).

## 6. Contraintes et techno
- Type de projet : web app (pas app mobile native).
- Stack principale :  
  - Front : HTML / CSS / JS (dans VS Code).
  - Back : PHP (procédural au début).
- BDD : MySQL / MariaDB (via XAMPP ou autre).
- Environnement :  
  - Développement local, upload sur GitHub.
  - Pas de hébergement payant prévu pour l’instant.
- Objectif pédagogique :  
  - Apprendre / consolider PHP.  
  - Mettre en pratique parcours utilisateur, validations côté client/serveur, gestion des sessions (`$_SESSION`), et organisation de projet (fichiers, dossiers, Git, GitHub).

## 7. Roadmap simplifiée
- Etape 1 :  
  - Spécifications + cahier des charges.
  - Maquettes (ou ébauches papier) des écrans.

- Etape 2 :  
  - Implémentation de l’accueil + objectif + date de début + date de fin.

- Etape 3 :  
  - Entrées / sorties / budget plaisir + calcul de faisabilité.
  
- Etape 4 :  
  - Page “problème” + lien de retour aux paramètres + préparation structure fichier pour dashboard.