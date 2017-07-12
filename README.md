APILITE
========================
Lightweight backend API solution

It is based on Symfony2 and aimed to provide a simple RESTful API backend for web and mobile applications.

INSTALLATION
--------------

* Run `composer install` in the project root
* Run `php app/console server:run` to start a development server

TESTS
--------------
Run `bin/phpunit -c app` to start all tests

USE
-------------
Current implementation of the API has a sample DB (SQLite) with 3 tables: **auth**, **authors** and **books**

Method|Public|Description
---|---|---
`GET /api/v1/auth`|YES|**Make this call first** to get an authentication token to use in non-public methods
`GET /api/v1/book`|YES|List all books
`GET /api/v1/author`|YES|List all authors
`GET /api/v1/book/{id}`|YES|Show a specified book
`GET /api/v1/author/{id}`|YES|Show a specified author
`DELETE /api/v1/book/{id}?token=<your_token>`|NO|Delete a specified book
`DELETE /api/v1/author/{id}?token=<your_token>`|NO|Delete a specified author
`POST /api/v1/book?token=<your_token>`|NO|Create a new book (request body params: [author_id, name, description])
`POST /api/v1/author?token=<your_token>`|NO|Create a new author (request body params: [name])
