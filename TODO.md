# TODO — Refacto & analyse approfondie (ImmobSite)

## 1) Diagnostic (fait/à faire)
- [x] Lire `routes/web.php`
- [x] Lire `PropertyController@index/show`
- [x] Lire `FavoriteController@toggle`
- [x] Lire `VisitRequestController@store`
- [x] Lire `Property`, `Favorite`, `PropertyPhoto`, `PropertyUsage`, `VisitRequest`
- [x] Lire les vues : `resources/views/properties/index.blade.php` + `resources/views/properties/show.blade.php`
- [x] Repérer incohérence schéma HTML favoris + duplication JS
- [x] Vérifier `photos/usages` : contrôleur `show()` n’utilise pas d’eager loading (risque N+1 si lazy loading)


## 2) Refacto progressif — favoris (priorité haute)
- [ ] Uniformiser les attributs HTML des boutons favoris (un seul schéma : `data-property-id`, `data-favorite-url`, `data-favorited`)
- [ ] Réduire la duplication du JS favoris (même code index/show)
- [ ] S’assurer que la synchro favoris index <-> show fonctionne (clique et état global)

## 3) Refacto — performance & données
- [ ] Charger en eager loading dans `PropertyController@show` au minimum `photos` et `usages`
- [ ] Déplacer le calcul `favoritePropertyIds` du Blade vers le contrôleur (1 requête)

## 4) Refacto — maintenabilité
- [ ] Extraire la carte annonce du listing dans un composant réutilisable
- [ ] Nettoyer / aligner filtres UI vs logique back (si nécessaire)

## 5) Validation
- [ ] Lancer `php artisan test`
- [ ] Tester manuellement :
  - [ ] favoris (ajouter/retirer) sur index
  - [ ] favoris (ajouter/retirer) sur show
  - [ ] pagination + favoris
  - [ ] page show sur annonce `publiee` et annonce non publiée

