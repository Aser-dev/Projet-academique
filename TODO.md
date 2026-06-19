# TODO - Tableau de bord Agent dynamique

- [x] Identifier la source du problème (compteurs non mis à jour après actions).
- [x] Ajouter un endpoint JSON `AgentDashboardController@stats`.
- [x] Ajouter la route `agent/dashboard/stats`.
- [x] Mettre à jour `resources/views/dashboard/agent.blade.php` pour rafraîchir les compteurs via `fetch()` toutes les 15 secondes.
- [x] Corriger le compteur « Demandes de visite » pour utiliser la même logique que la page `agent/visits`.
- [x] Vérifier que `php artisan test` passe.
- [ ] Améliorer la page `http://127.0.0.1:8000/agent/properties/agency/create` (selon feedback utilisateur).

