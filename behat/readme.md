# Install
- composer require --dev behat/behat
    - PHP mbstring required
- vendor/bin/behat -V

# Init
- vendor/bin/behat --init

# Ecriture d'un feature

    # language: fr
    Fonctionnalité: Tester le déploiement dev + preprod + prod
    
    Scénario: Test du get
    Etant donné que je démarre mon projet
    Quand j'envoie une valeur inférieur à 8
    Alors j'obtient "true"
    
    Scénario: Test du get trop grand
    Etant donné que je démarre mon projet
    Quand j'envoie une valeur supérieur à 7
    Alors j'obtient "false"

# Création du contexte : snippets
- vendor/bin/behat --dry-run --append-snippets
    - --dry-run : ignore l'analyse
    - --append-snippets : ajoute automatiquement les méthodes au "FeatureContext"
        - Ajouter use Behat\Behat\Tester\Exception\PendingException; si besoin