# Journal

```
symfony new nextonstack --full ; cd nextonstack # Création du projet avec toutes les outils utiles à un site web classique
```

Indiquer les paramêtres de connexion à la bdd et au serveur smtp dans le fichier **.env.local** en prenant **.env** pour modèle (ne pas éditer directement _.env_ qui est est envoyé dans le repo git)

```
symfony console make:user # Création de l'entité de type user pour l'authentification et ajout à la config de sécurité

symfony console make:migration
symfony console doctrine:migrations:migrate -n
```

Insertion de l'utilisateur admin
- obtenir un mot de passe encodé 
```
symfony console security:encode-password
```
- puis l'utiliser dans la commande suivante, en échappant les dollars. Le mot de passe est 'admin' dans l'exemple suivant.

```
echo "INSERT INTO \"user\" (id, username, roles, password, email, is_verified) VALUES (nextval('user_id_seq'), 'admin', '[\"ROLE_ADMIN\"]', \
  '\$argon2id\$v=19\$m=65536,t=4,p=1\$ubIusG9axbbokHIqCLvxPg\$5+zpfS9PDA/TdlO0749ibpOq/UY6InSmpo93DLs3xcY', 'admin@nextonstack.com', true)" | sql
```


```
symfony console make:auth # Génère template de connexion et class d'authentification

symfony composer require symfonycasts/verify-email-bundle
symfony console make:registration-form

symfony console make:entity Author
symfony console make:entity Work
# etc.

symfony console make:migration
symfony console doctrine:migrations:migrate -n

symfony composer req "admin:^3"
symfony console make:admin:dashboard

symfony console make:admin:crud
```

edit **config/packages/security.yml** : 

```yaml
    access_control:
      - { path: ^/admin/login, roles: PUBLIC_ACCESS }
      - { path: ^/admin, roles: ROLE_ADMIN }` 
```

Utilisation du template de EasyAdmin pour le formulaire de login : edition de src/Controller/SecurityController.php et remplacement de 

```php
return $this->render('security/login.html.twig', [
    'last_username' => $lastUsername,
    'error' => $error
]);
```

par 

```php
//Copié depuis https://symfony.com/bundles/EasyAdminBundle/current/dashboards.html#login-form-template
return $this->render('@EasyAdmin/page/login.html.twig', [
    'last_username' => $lastUsername,
    'error' => $error,

    'username_parameter' => 'username',
    'password_parameter' => 'password',
    'csrf_token_intention' => 'authenticate',

    // 'forgot_password_enabled' => true,
    // 'remember_me_enabled' => true,
]);
```
