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
