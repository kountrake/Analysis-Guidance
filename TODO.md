# TODO

## Page Accueil connecté

- [x] Le lien mes projets doit rediriger vers la page /myprojects

## Page Inscription - route: /register

- [x] Ajouter critères du mot de passe

## Page Mes projets - route: /myprojects

Cette page fait le listing de l'ensemble des projets d'un utilisateur

- [ ] Intégration de la maquette
- [ ] Faire le listing des projets d'un utilisateur

## Page projet - route: /mesprojets/{idprojet}

Cette page permet de regrouper l'ensemble des informations correspondant à un projet

- [ ] Faire une maquette de cette page
- [ ] Une partie persona avec tous les différents personas + bouton modifier (+ bouton télécharger ?)
- [ ] Une partie user story avec toutes les différentes US + bouton modifier (+ bouton télécharger ?)
- [ ] Une partie story map + bouton modifier (+ bouton télécharger ?)
- [ ] Une partie matrice ou simplement un lien (bouton) vers la page matrice chargeant les éléments de ce projet
  - => Les différents boutons modifier redirige vers la page en question en chargeant les éléments du projets

## Page personna

- [x] Ajouter en BDD un champ âge
- [x] Ajouter sur le site un champ prénom
- [x] Le bouton suivant ne fonctionne pas
- Cohérence site et BDD:
  - [x] Le champ caractéristique du site devrait être renommé en description et être un textarea sur le site et un text
    sur la BDD afin que les deux correspondent
  - [x] Le champ objectif devient une description des objectifs en un seul paragraphe (en faire un textarea sur le site
    et un text sur la BDD)

- [x] Rajouter un champ scénario en BDD permettant de stocker celui-ci (varchar(cb de char?) ou text ?)
- [x] Supprimer les boutons Ajouter
- [ ] Ajouter un bouton pour supprimer un persona
- [ ] Ajouter un bouton modifier pour changer les informations d'un
- [ ] Intégrer la fonctionnalité de suppression d'un persona
- [ ] Intégrer la fonctionnalité de modification
- [x] Corriger les bugs CSS -> certains affichages ne sont pas correct et si l'on réduit la fenêtre en hauteur ça
  devient un peu le bordel
- [ ] Mettre en place le bouton téléchargement

## Page User Story

- Le bouton générer envoie en BDD les infos rentrées dans le formulaire et renvoie sur cette même page avec en bas les
  valeurs de la précédente US stockée en BDD
- [ ] Mettre en place la fonctionnalité de création d'une User Story (@Papa Laye)
- [ ] Mettre un menu déroulant pour le champ "en tant que" où les propositions sont les différents rôles parmi les
  personas
- [x] Mettre directement en place 3 champs je suis satisfait si
- [x] Ajouter un bouton précédent afin de revenir sur la page persona
- [ ] Mettre en place le bouton téléchargement
- [ ] Toutes les US précédemment créées doivent être listées et résumées dans le bas de la page
  - [ ] Rajouter un bouton modifier sur chacune d'elle ainsi qu'un bouton supprimer
  - [ ] Mettre en place la fonctionnalité de modification
  - [ ] Mettre en place la fonctionnalité de suppression
- [x] Le bouton suivant ne fonctionne pas. Il doit rediriger vers la page /storymap

## Page story map

- [ ] Intégrer la maquette (@Lucas)
- [ ] Rajouter un bouton précédent => Le bouton suivant doit-il être également celui qui déclenche l'enregistrement des
  informations du formulaire en BDD ? => Vérifier la concordance entre maquette et BDD

## Page Matrice

- [ ] Intégrer la maquette (@Valentin)
- [ ] Rajouter un bouton précédent => Vérifier la concordance entre maquette et BDD

## Page score final

- [x] Le bouton fin de projet doit rediriger vers la page mes projets
- [x] Rajouter un bouton précédent

## Dossier (@Corentin)

- [ ] Refaire les US
- [ ] Rédaction
- [ ] Is/is not
- [ ] Does/does not
- [ ] Experience map
- [ ] Cout
- [ ] MCD à corriger
- [x] Demander la date de rendu

