ECHO iPhotomaton build
docker build -t iphotomaton .

docker stop cphotomaton
docker rm cphotomaton

docker run -d -p 80:80 --name cphotomaton iphotomaton