# GUIDE - Installation & Lancement (Laravel)

Ce guide explique comment installer et lancer le site **Laravel** à partir du code présent dans ce dépôt.

---

## 1) PRÉREQUIS

### Version PHP requise
- **PHP >= 8.3** (la configuration du projet indique `php: ^8.3` dans `composer.json`)

### Extensions PHP nécessaires
Généralement nécessaires pour une app Laravel avec MySQL et assets :
- `openssl`
- `pdo`
- `pdo_mysql` *(ou `pdo_pgsql` si vous utilisez PostgreSQL, et adapter la config)*
- `mbstring`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `curl`
- `fileinfo`

> Si vous utilisez **MySQL/MariaDB** (recommandé), vérifiez au minimum : `pdo_mysql`.

### Node.js et npm
- **Node.js** (version compatible avec Vite)
- **npm**

> Vérifiez aussi que vous êtes à l’aise avec `npm run dev` / `npm run build`.

### Composer
- **Composer** installé et accessible via `composer`.

### Base de données utilisée
Le projet utilise une connexion par défaut configurable via `.env`.

Dans `config/database.php`, la base par défaut est :
- `sqlite` (valeur par défaut)

Mais le projet supporte aussi (selon `.env`) :
- `mysql`
- `mariadb`
- `pgsql`
- `sqlsrv`

✅ Dans ce guide, on décrit l’installation pour **MySQL/MariaDB** (cas le plus courant). Pour SQLite, adaptez simplement les variables `.env`.

---

## 2) INSTALLATION

### Cloner le projet
```bash
git clone https://github.com/Aser-dev/Projet-academique.git
cd Projet-Academique
```

### Installer les dépendances PHP
```bash
composer install
```

### Installer les dépendances JS
```bash
npm install
```

### Copier le fichier `.env`
```bash
cp .env.example .env
```

*(Sur Windows PowerShell, utilisez plutôt `Copy-Item .env.example .env` si besoin.)*

### Générer la clé applicative
```bash
php artisan key:generate
```

### Configurer la base de données dans `.env`
Ouvrez `.env` et définissez au minimum :

#### Cas MySQL/MariaDB
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_immo
DB_USERNAME=root
DB_PASSWORD=
```

> Remarque : si `pdo_mysql` n’est pas activé, utilisez SQLite ou activez l’extension.

---

## 3) BASE DE DONNÉES

### Créer la base de données
Créez la base `DB_DATABASE` indiquée dans `.env`.

Exemple MySQL :
```sql
CREATE DATABASE db_immo;
```

### Lancer les migrations
```bash
php artisan migrate
```

### Lancer le seeder
```bash
php artisan db:seed
```

### Liste des comptes créés (emails & mots de passe)
Le seeder `database/seeders/DatabaseSeeder.php` crée (ou met à jour) les comptes suivants, avec le mot de passe **`password`** :

- **manager@immo.com** — `password` (rôle: manager)
- **agent@immo.com** — `password` (rôle: agent)
- **agent2@immo.com** — `password` (rôle: agent)
- **bailleur@immo.com** — `password` (rôle: bailleur)
- **bailleur2@immo.com** — `password` (rôle: bailleur)
- **client@immo.com** — `password` (rôle: client)
- **client2@immo.com** — `password` (rôle: client)

---

## 4) STORAGE ET IMAGES

### Créer le lien symbolique
```bash
php artisan storage:link
```

> Ce lien permet d’accéder aux fichiers de `storage/app/public` via `public/storage`.

### Structure des dossiers d’images
Le projet s’appuie sur un disque Laravel `public` (config `config/filesystems.php`) dont la racine est `storage/app/public`.

Les dossiers attendus (créés via la commande `propriete:storage-directories`) :

- `storage/app/public/propriete/villas/`
- `storage/app/public/propriete/appartements/`
- `storage/app/public/propriete/terrains/`
- `storage/app/public/propriete/commerces/`
- `storage/app/public/propriete/immeubles/`
- `storage/app/public/propriete/bureaux/`
- `storage/app/public/propriete/avatars/`

Et le dossier public (images statiques) :
- `public/images/`

### Ajouter des images dans le seeder
Le seeder insère des propriétés avec des chemins comme par exemple :
- `propriete/villas/villa f3.jpg`
- `propriete/terrains/terrain.jpg`
- `propriete/commerces/local commercial.jpeg`

Concrètement :
1. Copiez vos fichiers dans le dossier correspondant sous `storage/app/public/propriete/...`
2. Utilisez ensuite exactement le même chemin relatif **sans** le préfixe `storage/app/public/`.

Exemple :
- Fichier placé à : `storage/app/public/propriete/villas/ma_villa.jpg`
- Chemin utilisé dans `DatabaseSeeder.php` : `propriete/villas/ma_villa.jpg`

> Les fichiers doivent exister avant ou au moment de l’affichage pour éviter les images manquantes côté UI.

---

## 5) LANCER LE SITE

### Démarrer le serveur
```bash
php artisan serve
```

### Compiler/servir les assets
En mode dev :
```bash
npm run dev
```

*(Le projet utilise Vite pour gérer les assets.)*

### URL d’accès
- **http://127.0.0.1:8000**

---

## 6) COMPTES DE TEST

Récapitulatif des emails/mots de passe (tous avec `password`) :

- manager@immo.com / password
- agent@immo.com / password
- agent2@immo.com / password
- bailleur@immo.com / password
- bailleur2@immo.com / password
- client@immo.com / password
- client2@immo.com / password

---

## 7) COMMANDES UTILES

### Vider le cache
```bash
php artisan cache:clear && php artisan view:clear
```

### Réinitialiser la base
Pour repartir de zéro :
```bash
php artisan migrate:fresh --seed
```

> Si vous souhaitez aussi supprimer le stockage lié : supprimez puis relancez `php artisan storage:link`.

---

## Notes
- Les dossiers `propriete/*` peuvent être créés automatiquement via :
  ```bash
  php artisan propriete:storage-directories
  ```
- Le projet dispose d’une configuration de stockage via `config/filesystems.php` (disk `public`).

