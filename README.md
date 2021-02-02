# ebooks
A template of a ebook store using PHP

## before run
Before run you need to:
* create the file `env.php` with the `envs` *name*, *database*, *host*, *port*, *user*, *password*, *rounds* and *passphrase*, e.g.:
  ```php
  <?php
  	putenv('name=MariaDB');
  	putenv('database=tests');
  	putenv('host=localhost');
  	putenv('port=3306');
  	putenv('user=root');
  	putenv('password=');
  
  	putenv('rounds=2');
  	putenv('passphrase=longpassphrase');
  ?>
  ```
* run the following command: `php migrations/books.php`
* add the sellers: `php migrations/sellers.php SELLER_NAME_HERE SELLER_PASSWORD_HERE`

## how to run
Execute the following command: `php -S localhost:80 -t src/`

## add books
To add books access the [add page](http://localhost:80/add.php)