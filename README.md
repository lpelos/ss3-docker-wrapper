# SilverStripe 3 Docker Wrapper

A pre-configured environment that allows serving any SilverStripe 3 project
inside a Docker container by following a few simple steps.

## Dependencies

* Docker >= 17.12.0-ce
* Docker Compose >= 1.14.0

Refer to their official documentation on how to install
[Docker Engine](https://docs.docker.com/engine/installation) and
[Docker Compose](https://docs.docker.com/compose/install/).

## Config

1. Copy the content of the root directory of the SilverStripe 3 project to the
`./app` folder or create a symbolic link to it.
1. Adjust the project's file and folders permissions:
    ```
    $ cd ./app
    $ sudo chmod 666 .htaccess mysite/_config.php mysite/_config/config.yml
    $ sudo chmod 777 assets mysite
    ```
1. In `./app/mysite/_config/` edit all the the config files according to your preferences
1. In `./app/mysite/_config.php` ajust database configurations to match the configurations in `./config/_ss_environment.php`
1. [Start the Docker Compose service](#Serve)
1. Visit [localhost/dev/build/?flush](http://localhost/dev/build/?flush)
1. Visit [localhost/admin](http://localhost/admin)
1. Go to security tab and create a new admin user

## Installing

```
$ docker-compose build
```

## Serve

```
$ docker-compose up
```

## Apache Logs

To run either the following commands, the app's docker container must be up.

### Access log

```
$ docker exec app tail -f /var/log/apache2/access.log
```

### Error log

```
$ docker exec app tail -f /var/log/apache2/error.log
```

## MySQL Database

Replace the `[database name]` in the following commands by the name of the
database you configured in the `./app/mysite/_config.php` file.

### Backup

```
$ docker run --rm app /bin/bash -c 'mysqldump -u root -h localhost [database name] > /var/www/app/dump.sql'
```

### Restoring

```
$ docker run --rm [container name] /bin/bash -c 'cat /var/www/app/dump.sql | mysql -u root -D [database name]'
```
