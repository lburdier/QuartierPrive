# Tutoriel pour configurer un projet avec un site web, une base de données et importer les données SQLite vers MySQL

## 1. Créer un site web sous ISPConfig

[![ISPConfig_Logo](https://github.com/user-attachments/assets/2d4603c7-19bb-44f0-9ff6-b1b854f28941)](https://172.31.1.40:8080/login/)

La première étape consiste à créer un nouveau site web sous ISPConfig. Pour ce faire :
1. Connectez-vous à votre interface ISPConfig.
2. Allez dans la section **Sites Web**.
3. Cliquez sur **Ajouter un site Web**.
4. Remplissez les informations suivantes :
   - **Domaine** : `quartierprive.burdier.etu.sio.local` (ou le domaine que vous souhaitez utiliser).
   - **Document Root** : `/var/www/clients/client5/web74`.
   - **Quota disque** : 200 Mo.
   - **Quota de trafic** : 200 Mo.
   - **PHP** : Utilisez **PHP-FPM** pour un meilleur contrôle des processus PHP.
   - **Version PHP** : Choisissez la version PHP par défaut ou spécifiez une version compatible avec Laravel.
   - **Auto sous-domaine** : cochez si nécessaire (exemple : `www`).
5. Cliquez sur **Sauvegarder** pour enregistrer le site.

---

## 2. Créer un enregistrement DNS pour le domaine

Ensuite, créez un enregistrement DNS pour votre domaine afin de le relier à votre serveur :
1. Allez dans la section **DNS** de votre fournisseur d'hébergement.
2. Ajoutez un enregistrement de type **A** pour le domaine `quartierprive.burdier.etu.sio.local` pointant vers l'adresse IP de votre serveur (par exemple `172.31.1.40`).
3. Sauvegardez les modifications.

---

## 3. Créer une base de données et un utilisateur

1. Allez dans la section **Bases de données** dans ISPConfig.
2. Cliquez sur **Ajouter une base de données**.
3. Remplissez les informations suivantes :
   - **Nom de la base de données** : `c5quartierprive`.
   - **Nom d'utilisateur** : `c5quartierprive`.
   - **Mot de passe** : Créez un mot de passe pour cet utilisateur.
4. Sauvegardez les informations.

Assurez-vous que l'accès à la base de données est configuré pour permettre la connexion à distance si nécessaire.

---

## 4. Créer un utilisateur shell

1. Allez dans la section **Utilisateurs** dans ISPConfig.
2. Cliquez sur **Ajouter un utilisateur shell**.
3. Donnez-lui un nom d'utilisateur et un mot de passe.
4. Assurez-vous que cet utilisateur a l'accès approprié au répertoire `/var/www/clients/client5/web74`.
5. Sauvegardez l'utilisateur shell.

---

## 5. Connexion avec un outil comme WinSCP

Pour accéder au serveur, utilisez un outil comme **WinSCP** :
1. Ouvrez **WinSCP** et entrez l'IP de votre serveur `172.31.1.40`.
2. Entrez le **login** et le **mot de passe** de l'utilisateur shell que vous venez de créer.
3. Vous aurez ainsi un accès à votre répertoire distant.

---

## 6. Accéder à la base de données via PHPMyAdmin

1. Accédez à PHPMyAdmin via votre interface ISPConfig ou via un navigateur.
2. Connectez-vous avec l'utilisateur de la base de données `c5quartierprive` et son mot de passe.
3. Créez les tables nécessaires dans la base de données, si elles ne sont pas déjà présentes.

---

## 7. Convertir la base de données SQLite en MySQL

Utilisez un script Python pour convertir la base de données SQLite en MySQL :
1. Clonez le dépôt du projet SQLite to MySQL à l'aide de la commande suivante :
   ```bash
   git clone https://github.com/majidalavizadeh/sqlite-to-mysql.git
   ```
Naviguez vers le répertoire du projet :
```bash
cd sqlite-to-mysql
```

```bash
python export.py /chemin/vers/votre/database.sqlite /chemin/vers/votre/output_structure.sql --export-mode structure
```
8. Importer la structure dans PHPMyAdmin
Ouvrez PHPMyAdmin et sélectionnez la base de données c5quartierprive.
Allez dans l'onglet Structure et copiez-collez le contenu du fichier output_structure.sql dans l'éditeur SQL.
Exécutez la requête pour créer les tables.
9. Insérer les données dans MySQL
Récupérez le fichier contenant les requêtes d'insertion (les données SQLite converties).
Allez dans l'onglet SQL de PHPMyAdmin et collez les requêtes d'insertion (INSERT INTO).
Exécutez les requêtes pour insérer les données dans les tables MySQL.
Cela terminera la migration des données depuis SQLite vers MySQL et configurera votre projet Laravel pour qu'il fonctionne sur le serveur web.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all
modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a
modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video
tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging
into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in
becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in
the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell
via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
