# _Shoe Store Manager 2016_

#### _9-30-16_

#### By _**Stephen Newkirk**_

## Description

_Independent project for Epicodus PHP Class week 4. Site lets users add stores and brands and connections between the two._

## Specifications

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| Save new stores | Save "Shoe Empire" | Shoe Empire |
| Display a list of all saved stores | Navigate to store page | Shoe Empire, Heavenly Boots |
| Delete all saved stores | Click delete | *Empty list* |
| Update a store | Heavenly Boots->(New name = Boots to Boot) | Boots to Boot |
| Save new brands | Save "Niqee" | Niqee |
| Add a brand to a store | Add Niqee to Shoe Empire | Shoe Empire Brands: Niqee |
| Add a store to a brand | Add Heavenly Boots to Niqee | Stores that carry Niqee: Heavenly Boots |

## Setup/Installation Requirements

_In Terminal:_

`git clone 'URL'`

`$ cd 'directory name'`

`$ composer install`

`$ cd web`

`$ php -S localhost:8889`

_In Browser navigate to:_

`localhost:8889`

_Database:_

_Import compressed database from project folder in PHPMyAdmin or create from manual instructions_

## Manual Database Setup Instructions

_In Terminal:_

`mysql -uroot -proot`

`CREATE DATABASE shoes;`

`USE shoes;`

`CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));`

`CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));`

`CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id INT, store_id INT);`

****Make copy of hair_salon named hair_salon_test in PHPMyAdmin, copying all tables and columns but no data.****

## Known Bugs

_None yet_

## Support and contact details

_Stephen Newkirk: newkirk771@gmail.com_

## Technologies Used

_HTML,
PHP,
Silex,
Twig,
PHPUnit,
MySQL_

### License

*This webpage is licensed under the MIT license.*

Copyright (c) 2016 **_Stephen Newkirk_**
