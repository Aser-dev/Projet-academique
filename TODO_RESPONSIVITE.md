# TODO Responsivité — ImmoSite

## Problèmes repérés (pages visibles)
- Listing (`resources/views/properties/index.blade.php`) : hauteur hero fixe (580px / min 480px) => risque d’écrasement sur petits écrans.
- Grille : `xl:grid-cols-4` + `lg:grid-cols-3` OK, mais tailles image/texte peuvent être trop denses sur mobile.
- Show (détail) : largeur galerie/hauteur fixe (420px) => risque de trop grand sur mobile.
- `sticky top-24` sidebar => peut gêner sur mobile (besoin de désactiver sticky en dessous d’un breakpoint).
- Plusieurs blocs ont des `style="height:...px"` (non responsive).

## Plan refacto (progressif)
1) Remplacer les hauteurs fixes par des hauteurs responsive (Tailwind) :
   - Hero : `h-[520px] md:h-[580px]` + `min-h` via `min-h-[420px] md:min-h-[480px]`.
   - Galerie show : `h-[300px] sm:h-[380px] md:h-[420px]`.
2) Sidebar show : désactiver sticky sur mobile : `sticky top-24 md:sticky` ou `md:sticky`.
3) Cards listing : adapter l’image (ex: hauteur 170-200) avec breakpoints.
4) Boutons favoris + icônes : vérifier tap targets (>=44px) via w/h responsive.
5) Ajout de classe `break-words`/`truncate` maîtrisée pour éviter overflow.

## Validation
- Ouvrir sur mobile (viewport 375x812) :
  - index : hero + filtres + grille sans coupures
  - show : galerie, spec tiles, sidebar


