# lighthouse-app
TEST APPLICATION

To build:
docker build -t ninjakitteh69/lighthouse-app:v1.0.1 .

To run application (substitute image name built with one from docker hub):

docker run -dp 8080:80 ninjakitteh69/lighthouse-app:v1.0.1

Application runs on port 8080 over http.

Main pages are located at /index.php /view/index.php