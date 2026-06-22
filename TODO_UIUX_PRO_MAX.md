# TODO — UI/UX PRO MAX (Home + Cards + Show)

## Étape 1 — Card unifiée
- [ ] Harmoniser `resources/views/components/property-card-modern.blade.php`
  - badges (status/type) cohérents
  - price/FCFA
  - features tiles style identique
  - CTA identique (gradient + hover)
  - boutons favoris: accessibilité (type=button, aria-pressed si possible)

## Étape 2 — Featured sur Home via composant
- [ ] Mettre à jour `resources/views/welcome.blade.php`
  - remplacer la section Featured inline
  - utiliser `@include('components.property-card-modern')`

## Étape 3 — Page détails unifiée
- [ ] Harmoniser `resources/views/properties/show.blade.php`
  - styles conteneurs: arrondis/ombres identiques
  - badges: option/type status cohérents
  - stats tiles: même look que la card
  - CTA: même style que la card

## Étape 4 — Vérification
- [ ] Contrôler visuellement
  - home (grid + featured + empty)
  - page détails (favorite + visit modal)
