# Run : Lancement d'une image
- docker run hello-world
- docker run ubuntu /bin/echo 'Hello world'
- docker run -t -i ubuntu /bin/bash 
    - -t ouverture d'un terminal (tty)
    - -i sortie standard (stdin)
- docker run docker/whalesay cowsay iDalgo
- docker run idalgofr/docker-whale
- docker run -d ubuntu /bin/sh -c "while true; do echo hello world; sleep 1; done"
    - -d en background (daemon)
- docker run -d -P training/webapp python app.py
    - -P redirige tous les connexions réseau vers l'hôte 
        - -P = -p 5000 vers un port éphémère
        - -p 80:5000 = port 5000 du container redirigé vers le 80 du host
    - docker ps -l : 0.0.0.0:32768->5000/tcp => port local 32768
- docker run -d -p 80:5000 training/webapp python app.py
    
- docker ps
- docker ps -l
- docker ps -a
    - all
- docker logs __NAME__
- docker stop __NAME__

- docker stop __NAME__
- docker start __NAME__
- docker restart __NAME__

- docker rm __NAME__
- docker rm $(docker ps -a -q)
    - Delete all docker containers

# Port : Lecture simple du port d'écoute
- docker port __NAME__ __PORT_APP__

# Logs : Logs en direct
- docker logs -f __NAME__
    - -f : tail -f

# Connexion type bash
- docker exec -it __NAME__ bash
    
# Top : Top
- docker top __NAME__

# Inspect : Fichier de configuration du container (en JSON)
- docker inspect __NAME__

# Build : Construction d'une image
- docker build -t docker-whale .
- docker build -t idalgofr/docker-whale:v2 .

Créer un fichier "Dockerfile"
# This is a comment
    FROM ubuntu:14.04
    MAINTAINER Kate Smith <ksmith@example.com>
    RUN apt-get update && apt-get install -y ruby ruby-dev
    RUN gem install sinatra
    
- FROM : image de base
- MAINTENER : Auteur
- RUN : exécutions

# Tag 
- docker tag __ID__ ouruser/sinatra:devel

# Images : Liste des images téléchargée ou construites
- docker images

- docker rmi $(docker images -q)
    - Delete all docker images
- docker rmi -f 7d9495d03763
- docker rmi -f docker-whale

# Hub : Création d'un dépot pour les images
https://docs.docker.com/engine/getstarted/step_six/

- docker tag __IMAGE_ID__ idalgofr/docker-whale:latest

- docker login
- docker login: idalgodatasport

- docker push idalgofr/docker-whale

- docker search idalgo

## Commit
Modification image
- docker run -t -i training/sinatra /bin/bash
- apt-get install -y ruby2.0-dev ruby2.0
- gem2.0 install json

docker commit -m "Added json gem" -a "Kate Smith" 0b2616b0e5a8 ouruser/sinatra:v2

- docker run -t -i ouruser/sinatra:v2 /bin/bash

# Network
- docker network ls
- docker network disconnect __NETWORK__ __NAME__
- docker network create -d bridge my-bridge-network
    - -d use the "bridge" driver
- docker network inspect my-bridge-network
- docker network connect my-bridge-network __NAME__

- docker run -d --net=my-bridge-network --name __NAME__ training/postgres
- docker inspect --format='{{json .NetworkSettings.Networks}}'  __NAME__

... https://docs.docker.com/engine/tutorials/networkingcontainers/

# Volume
- docker run -d -P --name __NAME__ -v /src/webapp:/webapp training/webapp python app.py
    - -v __HOST__:(absolute+mount)__CONTAINER__
- docker run -d -P --name __NAME__ -v /src/webapp:/webapp:ro training/webapp python app.py
    - :ro readonly
    
docker run --rm -v /foo -v awesome:/bar busybox top
    
## Flocker : iSCSI, NFS, FC (install flocker)
docker run -d -P \
  --volume-driver=flocker \
  -v my-named-volume:/webapp \
  --name web training/webapp python app.py
  
# Volume container 
- docker create -v /dbdata --name dbstore training/postgres /bin/true

- docker run -d --volumes-from dbstore --name db1 training/postgres
- docker run -d --volumes-from dbstore --name db2 training/postgres

# Backup
- docker run --rm --volumes-from dbstore -v $(pwd):/backup ubuntu tar cvf /backup/backup.tar /dbdata

# Restore
- docker run -v /dbdata --name dbstore2 ubuntu /bin/bash
- docker run --rm --volumes-from dbstore2 -v $(pwd):/backup ubuntu bash -c "cd /dbdata && tar xvf /backup/backup.tar --strip 1"

# Compose
docker-compose.yaml
- docker-compose up
- docker-compose up -d
    - -d daemon/detached
- docker-compose -f ...
    -f override surcharche de fichiers de configuration yaml (production)
- docker-compose stop


- docker-compose build web
- docker-compose up --no-deps -d web


- version: utiliser la dernière 2.1
    - Normes d'écriture
        - -> 2 ajouter services + indentation 


    version: '2'
    services:
    web:
      build: .
      ports:
        - "5000:5000"
      volumes:
        - .:/code
      depends_on:
        - redis
    redis:
      image: redis
      
- docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
    -f override surcharche de fichiers de configuration yaml (base + production)

docker-compose.yaml
      
    web:
      image: example/my_web_app:latest
      links:
        - db
        - cache
    
    db:
      image: postgres:latest
    
    cache:
      image: redis:latest

docker-compose.override.yaml
      
    web:
        build: .
        volumes:
          - '.:/code'
        ports:
          - 8883:80
        environment:
          DEBUG: 'true'
    
    db:
        command: '-d'
        ports:
          - 5432:5432
    
    cache:
        ports:
          - 6379:6379
          
docker-compose.prod.yaml

    web:
      ports:
        - 80:80
      environment:
        PRODUCTION: 'true'
    
    cache:
      environment:
        TTL: '500'