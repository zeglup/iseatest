###Install
Get composer
```sh
https://getcomposer.org/download/
```
Install packages
```sh
$ composer install
```

Create .env file from .env.dist and change values.

#####Database
```sh
$ bin/console doc:database:create
$ bin/console doc:schema:update --force
$ bin/console doc:fix:load -n
```

#####Run server
```bash
$ php bin/console server:run
```
