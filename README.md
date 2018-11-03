[![Build Status](https://travis-ci.org/shadownetX/terraqueus-api.svg?branch=master)](https://travis-ci.org/shadownetX/terraqueus-api)

## TERRAQUEUS API

**Requirements:**

* [Docker](https://www.docker.com/get-docker)
* [Docker-compose](https://docs.docker.com/compose/gettingstarted/)

> You could use ```ctop``` for monitoring docker containers. Please visit https://github.com/bcicen/ctop

**About this stack:**

* **[nginx:1.15-alpine]** :  Use ```https://www.api.trqs:8443``` with this configuration : ```sudo sh -c "echo '127.0.0.1   www.api.trqs' >> /etc/hosts"```
* **[php:7.2-fpm-alpine]** 
* **[redis:4-alpine]** Check "About: Redis" section.
* **[mysql:5.7]**

### Manipulate containers

| **For short** | **Custom command**                  | **Purpose**                          |
|---------------|-------------------------------------|---------------------------------------|
| BUILD         | ```bin/docker build```              | Build the app                         |
| RUN           | ```bin/docker run```                | Run the app                           |
| STOP          | ```bin/docker stop```               | Stop the app                          |
| DESTROY       | ```bin/docker destroy```            | Destroy the app                       |
| INSTALL       | ```bin/docker install```            | Install the app & demo db content     |
| EXPELLIARMUS  | ```bin/docker expelliarmus```       | Prune docker env                      |
| AVADAKEDAVRA  | ```bin/docker avadakedavra```       | Stop then destroy containers + images |

### Access to containers

| **For short** | **Custom command**                    | **Purpose**                                            |
|---------------|---------------------------------------|--------------------------------------------------------|
| EXEC-PHP      | ```bin/docker exec-php [ARGS]```      | Execute a command inside the php container             |
| EXEC-ROOT     | ```bin/docker exec-php-root [ARGS]``` | Execute a command as ROOT inside the php container     |
| BASH          | ```bin/docker bash```                 | Access /bin/bash or sh (alpine)                        |
| COMPOSER      | ```bin/docker composer [ARGS]```      | Execute composer                                       |
| SYMFONY       | ```bin/docker console [ARGS]```       | Execute Symfony's console (bin/console)                |

### Informations about containers

| **For short** | **Custom command**                           | **Purpose**                           |
|---------------|----------------------------------------------|---------------------------------------|
| PS            | ```bin/docker ps```                          | List all running containers           |

##### About: [Redis](https://redis.io/)

Check configuration using : ```docker-compose exec redis redis-cli ping```.
It should display ```PONG```!
