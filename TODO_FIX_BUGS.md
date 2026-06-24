# TODO_FIX_BUGS

## ✅ Favoris - page "Mes biens favoris"
- [x] Corriger `event` non défini dans `resources/views/client/favorites.blade.php`
  - bouton: `onclick="toggleFavorite(event, {{ $property->id }})"`
  - fonction: `function toggleFavorite(event, propertyId) { ... }`
  - remplacer la ligne `event.stopPropagation();` (indentation)

## 🔜 Prochaines vérifications manuelles (recommandées)
- [ ] Ouvrir la page `Mes biens favoris`
- [ ] Cliquer sur l’icône cœur d’une annonce
- [ ] Vérifier :
  - pas d’erreur console
  - visuel du cœur mis à jour
  - navigation `A` de la carte non déclenchée

