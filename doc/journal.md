# Journal

```
symfony new nextonstack --full ; cd nextonstack # Création du projet avec toutes les outils utiles à un site web classique
```

Indiquer les paramêtres de connexion à la bdd et au serveur smtp dans le fichier **.env.local** en prenant **.env** pour modèle (ne pas éditer directement _.env_ qui est est envoyé dans le repo git)

```
symfony console make:user # Création de l'entité de type user pour l'authentification et ajout à la config de sécurité

symfony console make:migration
symfony console doctrine:migrations:migrate -n

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
