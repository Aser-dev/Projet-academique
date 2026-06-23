# TODO - Ajout expert-card sur la page accueil

- [ ] Ajouter une section "PLATFORM EXPERTS" dans `resources/views/properties/index.blade.php`.
- [x] Afficher la section uniquement si `!request()->hasAny(['search','type','option'])`.
- [x] Réutiliser `$platformExperts` fourni par `PropertyController@index`.
- [x] Utiliser `@include('components.expert-card', ['expert' => $expert])` pour chaque expert.
- [x] Vérifier que le template ne casse pas le rendu (variables/conditions).

# TODO - Icône favori (page accueil)
- [ ] Mettre la même logique AJAX/icone que l’ancienne version sur l’accueil.
- [ ] S’assurer que le JS cible bien les bons boutons via data-attributes.



