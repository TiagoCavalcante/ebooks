# ebooks
A template of a ebook store using PHP

## before run
Before you initialize the server you need to initialize the MySQL and execute the commands below:
```sql
DROP DATABASE IF EXISTS bookstore;
CREATE DATABASE bookstore;
USE bookstore;
CREATE TABLE books (
	id INT AUTO_INCREMENT,
	name VARCHAR(255),
	description TEXT,
	price DECIMAL (5,2),
	PRIMARY KEY (id)
);
```
And after this add the books.

## run
Execute the following command: `cd src && php -S localhost:80`
