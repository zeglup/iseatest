###Install
```sh
$ composer install
```

Create .env file from .env.dist and change values.

#####Database
```sh
$ bin/console doc:database:create
$ bin/console doc:schema:update --force
```

#####Run server
```bash
$ php bin/console server:run
```
