# BASEX With Orlando Drupal

## Available services

- database
- drupal
- basex

## Getting started

- Run `docker-compose -p basex_orlando up --detach`
- To check the logs of one of the service:
  `docker-compose -p basex_orlando logs --follow <service_name>`. E.g.
  `docker-compose -p basex_orlando logs --follow drupal`

## Testing basex from Drupal service

Run `docker container exec -it basex_orlando_drupal_1 bash` to enter into bash
mode into the drupal container.

### _Default_ connections info

- `BASEX_ROOT_USER`: `admin`. This the root user name.
- `BASEX_ROOT_PASSWORD`: `admin`. This the root user password.
- `BASEX_DATABASE`: `orlando`. By default the basex server database create a
  database using this environment variable.
- `BASEX_USER`: `orlando`. This the user who is associated with the default
  (`BASEX_DATABASE`) database and they are given full permission on it.
- `BASEX_PASSWORD`: `orlando`. This the password used by `BASEX_USER`.

### Testing REST connection

Curl can be used to test the connection on the default orlando database. The
syntax could look like `curl -s --user <user>:<password> <url>`. The url syntax
is as follow `http://<host>:<port>/rest/<basex_query>`. More information on the
url can be found at https://docs.basex.org/wiki/REST. In our case the `<host>`
is `basex` and the port `8984`. For example to get information on the
`orlando` database we can run
`curl -s --user orlando:orlando http://basex:8984/rest/orlando\?command\=info` while in the `drupal` service.

### Using the php folder

The php folder contain som modified php script taken from
[basex](https://github.com/BaseXdb/basex/tree/master/basex-api/src/main/php)
repo. You can test it by:

1. Copying the php folder inside the drupal container by running
   `docker container cp php basex_orlando_drupal_1:/tmp`
2. `docker container exec -it basex_orlando_drupal_1 bash` to enter into bash
   mode inside the drupal container
3. Then Run `cd /tmp/php` to move into the copied php folder inside the drupal
   container.
4. Most of the php files in `php` folder still need some modification to work
   properly but `AddExample.php` is ready and can be tested by running
   `php AddExample.php`.
