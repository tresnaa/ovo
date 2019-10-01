# ovo

## project environment 
1. Windows 7 64 bit
2. XAMPP 7.2.22
3. PHP 7.2
4. MySQL 5 / MariaDB
5. Phalcon Framework
6. Bootstrap 3

## phalcon & project installation
1. Copy php_phalcon.dll from 'ext' folder to /xampp/php/ext
2. At least enable this php extensions: 
- curl
- gettext
- gd2
- json
- mbstring
- pdo_*
- fileinfo
- openssl
3. Import database ovo.sql from 'database' folder
4. Base URL & Database setting in the index.php file
5. Open http://localhost/ovo/

## project simulation
Default Page is Redeem Form

You can fill User ID/Phone Number and Reward Code


## for User ID/Phone Number
You can use : 

1	Deni	08120092345

2	Gilbert	08120092346

3	Brandon	08560092341

4	There	08770092345

5	Jill	08571192345

6	Novan	08781292341

7	Lita	08130092349

8	Roy	08110092346

9	Steven	08570092567

10	Nelson	08131112343

## for reward code
You can use

OVOTODAY (limit : 200000)

BAKULOVOJKT (limit : 300000)

## project structure
- app (controllers, models, forms, views)

- public (assets, css, js)

- public/index.php (to setting the project, database, base url, etc)

- database (ovo.sql)

- ext (php_phalcon.dll)

