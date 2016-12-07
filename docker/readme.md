# DEV
- docker build -t testDocker-nginx-img .
- docker run --name testDocker-nginx-app -d -p 80:80 testDocker-nginx-img