# Guide de Test - Cahier des Charges Implémenté

## 🎯 Vue d'ensemble
Ce document décrit comment tester les fonctionnalités implémentées pour l'application ImmobSite en fonction des exigences du cahier des charges.

## 📋 Exigences Implémentées

### EF-B1: Filtrage Avancé des Propriétés
**Route:** `/` (Page d'accueil)

**À Tester:**
1. **Filtre par Option (Vente/Location)**
   - Cliquez sur les tabs "À Vendre" ou "À Louer"
   - Vérifiez que seules les propriétés de l'option sélectionnée s'affichent

2. **Filtre par Type de Propriété**
   - Sélectionnez "Terrain", "Bâtiment", "Appartement", "Villa", ou "Commerce"
   - Les propriétés du type sélectionné doivent s'afficher

3. **Filtre par Usage**
   - Sélectionnez "Résidence", "Bureau", "Commerce", ou "Agriculture"
   - Vérifiez le filtrage

4. **Filtre par Zone Géographique**
   - Entrez un nom de zone (ex: "Ouagadougou")
   - Seules les propriétés de cette zone s'affichent

5. **Filtre par Prix**
   - Sélectionnez une plage de prix
   - Vérifiez que seules les propriétés dans la plage s'affichent

### EF-B4: Historique des Demandes de Visite
**Route:** `/client/visits-history`

**À Tester:**
1. **Authentifiez-vous en tant que Client**
2. **Allez à "Mes Demandes de Visite"**
3. **Vérifiez l'affichage:**
   - Propriété, Adresse, Date de demande
   - Status: En Attente (jaune), Validée (verte), Refusée (rouge)
4. **Cliquez "Voir Propriété"** pour accéder aux détails

### EF-D1: Rejet d'Annonce avec Raison
**Route:** `/agent/validations` (Agent seulement)

**À Tester:**
1. **Créez une propriété en tant que Bailleur** (Status: en_attente)
2. **Connectez-vous en tant qu'Agent**
3. **Allez à "Annonces en Attente de Validation"**
4. **Cliquez "Refuser"**
5. **Entrez une raison du refus** (ex: "Photos de mauvaise qualité")
6. **Vérifiez que:**
   - La propriété change de statut à "Retirée"
   - La raison s'affiche au bailleur dans son dashboard
   - Le bailleur reçoit une notification (optionnel)

### EF-D5: Gestion des Utilisateurs (Manager)
**Route:** `/manager/users`

**À Tester:**
1. **Connectez-vous en tant que Manager**
2. **Allez à "Gestion des Utilisateurs"**

**Créer un Utilisateur:**
- Cliquez "+ Créer Utilisateur"
- Remplissez le formulaire (Nom, Email, Mot de passe, Rôle, Téléphone)
- Vérifiez que l'utilisateur est créé

**Éditer un Utilisateur:**
- Cliquez "Éditer" sur un utilisateur
- Modifiez les détails
- Vérifiez que les modifications sont sauvegardées

**Supprimer un Utilisateur:**
- Cliquez "Supprimer" (avec confirmation)
- Vérifiez que l'utilisateur est supprimé

### EF-D6: Affectation Client-Agent (Manager)
**Route:** `/manager/affect-client`

**À Tester:**
1. **Connectez-vous en tant que Manager**
2. **Créez au moins un Client et un Agent** (via EF-D5)
3. **Allez à "Affecter Client"** (lien dans le menu manager)
4. **Sélectionnez un Client et un Agent**
5. **Cliquez "Affecter"**
6. **Vérifiez que le Client est affecté à l'Agent**

### EF-D7: Tableau de Bord Manager
**Route:** `/manager/dashboard`

**À Tester:**
1. **Connectez-vous en tant que Manager**
2. **Allez au Dashboard**
3. **Vérifiez l'affichage:**
   - Total de propriétés
   - Propriétés en attente de validation
   - Demandes de visite totales
   - Résumé des utilisateurs (Clients, Bailleurs, Agents)
   - Propriétés par Type (graphique/tableau)
   - Demandes de visite récentes

### EF-D8: Retrait d'Annonce (Manager)
**Route:** Actions depuis `/manager/dashboard`

**À Tester:**
1. **En tant que Manager**
2. **Trouvez une propriété publiée**
3. **Cliquez "Retirer Annonce"**
4. **Vérifiez que le statut change à "Retiree"**

### ENF-9: Tests Unitaires
**Exécuter les tests:**
```bash
php artisan test
```

**Tests disponibles:**
- `PropertyFilteringTest`: Filtrage par type, option, location, prix
- `FavoriteToggleTest`: Ajout/suppression de favoris
- `VisitRequestTest`: Création de demandes, validation par agent
- `PropertyValidationTest`: Validation/rejet d'annonces
- `ManagerUserManagementTest`: Création d'utilisateurs, affectation, permissions

## 🔧 Configuration pour Tester

### 1. Déployer les migrations
```bash
php artisan migrate
```

### 2. Créer des utilisateurs de test
```bash
php artisan tinker

# Créer un Manager
User::create([
    'name' => 'Manager',
    'email' => 'manager@test.com',
    'password' => bcrypt('password'),
    'role' => 'manager'
])

# Créer un Agent
User::create([
    'name' => 'Agent',
    'email' => 'agent@test.com',
    'password' => bcrypt('password'),
    'role' => 'agent'
])

# Créer un Bailleur
User::create([
    'name' => 'Bailleur',
    'email' => 'bailleur@test.com',
    'password' => bcrypt('password'),
    'role' => 'bailleur'
])

# Créer un Client
User::create([
    'name' => 'Client',
    'email' => 'client@test.com',
    'password' => bcrypt('password'),
    'role' => 'client'
])

exit
```

### 3. Créer des propriétés de test
Utilisez le formulaire depuis le dashboard Bailleur ou l'interface client-side.

### 4. Lancer l'application
```bash
php artisan serve
```
Accédez à `http://localhost:8000`

## 📊 Matrice de Contrôle d'Accès

| Route | Client | Bailleur | Agent | Manager | Visiteur |
|-------|--------|----------|-------|---------|----------|
| / | ✅ | ✅ | ✅ | ✅ | ✅ |
| /client/dashboard | ✅ | ❌ | ❌ | ❌ | ❌ |
| /client/visits-history | ✅ | ❌ | ❌ | ❌ | ❌ |
| /bailleur/dashboard | ❌ | ✅ | ❌ | ❌ | ❌ |
| /agent/validations | ❌ | ❌ | ✅ | ❌ | ❌ |
| /manager/dashboard | ❌ | ❌ | ❌ | ✅ | ❌ |
| /manager/users | ❌ | ❌ | ❌ | ✅ | ❌ |

## 🐛 Dépannage

**Problème:** Les filtres ne fonctionnent pas
- Vérifiez que vous avez exécuté `php artisan migrate`
- Vérifiez que les propriétés ont un statut "publiee"

**Problème:** Accès refusé au dashboard manager
- Vérifiez que vous êtes connecté en tant que manager
- Vérifiez les middleware dans routes/web.php

**Problème:** Les demandes de visite ne s'affichent pas
- Vérifiez que l'utilisateur est authentifié
- Vérifiez que des VisitRequests existent dans la base de données

## ✅ Checklist de Validation

- [ ] Filtrage EF-B1 fonctionne
- [ ] Historique demandes EF-B4 accessible
- [ ] Rejet avec raison EF-D1 opérationnel
- [ ] Gestion utilisateurs EF-D5 complète
- [ ] Affectation client-agent EF-D6 fonctionnelle
- [ ] Dashboard manager EF-D7 affiche les stats
- [ ] Retrait annonce EF-D8 possible
- [ ] Tests unitaires passent (ENF-9)
- [ ] UI moderne et responsive
- [ ] Toutes les routes protégées correctement
