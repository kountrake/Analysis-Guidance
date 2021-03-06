# TODO

## Page Accueil connecté

- Le lien mes projets et mon compte sont les mêmes. Ne devrions-nous pas créer une simple page listant les différents
  projets d'un utilisateur afin que le lien mes projets ait un réel intérêt ?
    - => Création d'une maquette ?

## Page profil

- [ ] Lister les différents projets d'un utilisateur
    - Chaque projet doit être lien vers une page regroupant l'intégralité des informations concernant ce projet => Cette
      maquette n'a pas encore été créée

## Page projet

Cette page permettra de regrouper l'ensemble des informations correspondant à un projet

- [ ] Faire une maquette de cette page
    - [ ] Une partie persona avec tous les différents personas + bouton modifier (+ bouton télécharger ?)
    - [ ] Une partie user story avec toutes les différentes US + bouton modifier (+ bouton télécharger ?)
    - [ ] Une partie story map + bouton modifier (+ bouton télécharger ?)
    - [ ] Une partie matrice ou simplement un lien (bouton) vers la page matrice chargeant les éléments de ce projet
        - => Les différents boutons modifier redirige vers la page en question en chargeant les éléments du projets
- [ ] Intégration de la maquette

## Page personna

- Ne pas se préoccuper des boutons ajouter
- [ ] Ajouter en BDD un champ age
- [ ] Ajouter sur le site un champ prénom
- [ ] Le bouton suivant ne fonctionne pas
- Cohérence site et BDD:
    - Le champ caractéristique du site devrait être renommé en description et être un textarea afin que les deux
      correspondent
    - Le champ objectif ne devrait-il pas en être de même ? Une sorte de description des objectifs en un seul paragraphe
    - Description et objectifs sont-ils repris plus tard dans l'analyse que propose le site ?
    - La BDD n'a pas de champ scénario permettant de stocker celui-ci (varchar(cb de char?))
- [ ] Il n'y a actuellement aucun moyen de supprimer un persona ou d'en modifier les informations
- [ ] Corriger les bugs CSS -> certains affichages ne sont pas correct et si l'on réduit la fenêtre en hauteur ça
  devient un peu le bordel
- [ ] Mettre en place le bouton téléchargement

## Page User Story

- Ne pas se préoccuper du bouton ajouter pour le moment
- Le bouton générer envoie en BDD les infos rentrées dans le formulaire et renvoie sur cette même page avec en bas les
  valeurs de la précédente US stockée en BDD
- [ ] Mettre en place la fonctionnalité de création d'une User Story (@Papa Laye)
- [ ] Mettre un menu déroulant pour le champ "en tant que" où les propositions sont les différents rôles parmi les
  personas
- [ ] Ajouter un bouton précédent afin de revenir sur la page persona
- [ ] Mettre en place le bouton téléchargement
- [ ] Toutes les US précédemment créées doivent être listées et résumées dans le bas de la page
    - [ ] Rajouter un bouton modifier sur chacune d'elle ainsi qu'un bouton supprimer
    - [ ] Mettre en place la fonctionnalité de modification
    - [ ] Mettre en place la fonctionnalité de suppression
- [ ] Le bouton suivant ne fonctionne pas. Il doit rediriger vers la page /storymap

## Page story map

- [ ] Intégrer la maquette (@Lucas)

## Page Matrice

- [ ] Intégrer la maquette (@Valentin)