# SilverStripe 3 Docker Wrapper

A pre-configured environment that allows serving any SilverStripe 3 website
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
1. In `./app/mysite/_config.php` adjust database configurations to match the configurations in `./config/_ss_environment.php`
1. [Start the Docker Compose service](#Serve)
1. Visit [localhost/dev/build/?flush](http://localhost/dev/build/?flush)
1. Visit [localhost/admin](http://localhost/admin)
1. Go to security tab and create a new admin user

## Serve

```
$ docker-compose up
```

The website will then be available at http://localhost.

## Mailcatcher

[Mailcatcher](https://mailcatcher.me) runs a super simple SMTP server which
catches any message sent to it to display in a web interface.

### Config

If you want the local mailcatcher service to catch emails sent by the
containerized SilverStripe 3 website, you must change its STMP configuration to

**server:** mailcatcher

**port:** 1025

Example `app/mysite/_config/smtp.yml`:

```yaml
---
Name: mysmtp
After: mysite
---
SmtpMailer:
  conf:
    default_from:
      name: Sender Name
      email: sender@example.com
    charset_encoding: utf-8
    server: mailcatcher
    port: 1025
    debug: 1
    lang: pt_BR

```

### Inbox

By running the command in [Serve](#Serve) a local mailcatcher server will
automatically be started together with the website server.

Check out http://localhost:1080 to see the email captured by mailcatcher.

## Apache Logs

To run either the following commands, the app's docker container must be up.

### Access log

```
$ docker-compose exec app tail -f /var/log/apache2/access.log
```

### Error log

```
$ docker-compose exec app tail -f /var/log/apache2/error.log
```

## MySQL Database

Replace the `[database name]` in the following commands by the name of the
database you configured in the `./app/mysite/_config.php` file.

### Backup

```
$ docker-compose run --rm app /bin/bash -c 'mysqldump -u root -h localhost [database name] > /var/www/app/dump.sql'
```

### Restoring

```
$ docker run --rm [container name] /bin/bash -c 'cat /var/www/app/dump.sql | mysql -u root -D [database name]'
```
