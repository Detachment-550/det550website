This site is a fork of MITR project website that was built to track and simply ROTC life. This site tracks ROTC 
attendance and provides a centralized communication system.

## Technology Used
- [Select2](https://select2.org/): Used for the searchable dropdowns
- [CodeIgniter](https://codeigniter.com/user_guide/index.html): The framework which the site runs on
- [Bootstrap](https://getbootstrap.com/docs/4.4/getting-started/introduction/): The front end html and css framework the 
site uses
- [MomentJS](https://momentjs.com/): Used to format dates in JS
- [jQuery](https://jquery.com/): Used to simplify JS code
- [Tabulator](http://tabulator.info/docs/4.5): Used for displaying table information
- [Tiny MCE](https://www.tiny.cloud/docs/): Used as a word editor in the web
- [MySQL](https://dev.mysql.com/downloads/installer/): Database language
- [PHP](https://windows.php.net/download/): Server code language
- [Eloquent](https://laravel.com/docs/master/eloquent): Database Object Relational Model 
- [MkDocs](): Used to create the html for the documentation from the Markdown
- [MkDocs Material Theme](https://github.com/squidfunk/mkdocs-material): Used to give a theme to the documentation
- [Python MkDocs Extension](https://squidfunk.github.io/mkdocs-material/extensions/pymdown/)

## Access the cPanel database

### Development Site
First you have to go the cPanel site 'https://union.rpi.edu:2083/' where you can log in with the following credentials:

```
Username: afrotcdev
Password: P-l@Fe$nq6z-
```

You will then have access to all of the back end side of the website.

### Production Site

To manage the cPanel account for the Production site use this 
[cPanel](https://a2plcpnl0892.prod.iad2.secureserver.net:2083/cpsess1856006599/frontend/paper_lantern/index.html?login=1&post_login=23064285561848) 
link.

## Filezilla

### Devlopment Site

To use Filezilla create a new site in the site manager section. You will need to set the following information for the 
afrotc site connection:

```
Protocol: SFTP
Host: ftp.union.rpi.edu
Logon Type: Normal
User: afrotcdev
Password: P-l@Fe$nq6z-
```

You will also need to have the vpn running a connection to the rpi vpn in order to ssh in to the file system. This can 
be accomplished by going to the following website 
https://dotcio.rpi.edu/services/network-remote-access/vpn-connection-and-installation and follow the instructions.

### Production Site

The production's cPanel ssh login information is as follows: 

```
Username: g7afzsg72ror
Password: F@lcons550
```

To log on you must use the server IP address and use SSH protocol: 

```bash
107.180.9.193
```
   
## Windows Development Set Up

#### Local Database Configuration
1. First install MYSQL for windows community edition at the following link: 
[Windows MySQL Installer](https://dev.mysql.com/downloads/installer/)
2. Run through the installation process and remember what you set your root password to because you will need it later.
3. Go into the project and edit the following file application/config/database.php.
4. In this file fill out the following information according to what you configured in the installation of your version 
of MYSQL.
5. At this point you will need to change the way the database is configured for authentication. Use the following 
command with your username and password for the database user who will access the shelterenterprise database TODO Find command.
6. Then copy the schema located in the repository sql/shelterenterprises.sql and run that code under a schema titled 
shelterenterprise. This will structure your database for the website.

#### Local PHP Configuration
1. Download the latest version of php at the following link: [PHP Download](https://windows.php.net/download/)
2. Extract the zip folder to a folder where you'd like to store PHP. 
3. Go in this folder and find the file titled 'php.ini - development' and create a new document in the same directory called 
php.ini. This will be the configuration settings file of your local PHP environment.
4. Edit this file and uncomment the following line:

```php
extension_dir = "ext"
```

to allows the computer to find the extensions 
like mysqli that you will need.
5. You must then find the line: 

```php
;extension=mysqli
```

Uncomment it to allow php to use that extension. (To uncomment remove the ';')
6. Now if you were to attempt to run the site you will most likely get the following error: 

```php
Message: mysqli::real_connect(): The server requested authentication method unknown to the client [caching_sha2_password]
```

To fix this use one of the following sql commands under your schema shelterenterprise:

```sql
ALTER USER 'mysqlUsername'@'localhost' 
IDENTIFIED WITH mysql_native_password 
BY 'mysqlUsernamePassword';
```

or if you are creating a user for the database:

```sql
 CREATE USER 'jeffrey'@'localhost' 
 IDENTIFIED WITH mysql_native_password 
 BY 'password';
```

To run your locally hosted site run the following in your terminal. 
Note: you can use any port you wish to that is not already in use. Using port 8040 is not required. If you do choose to 
use a different port just update the application/config/config.php file accordingly.

```
"C:\Path to your php exe\php.exe" -S localhost:8040 -t C:\Path to the project folder\shelterenterprises
```

Now your windows environment should be ready to develop! I highly recommend using PHP Storm for your IDE.

## Mac OS Development Set Up

6. Now if you were to attempt to run the site you will most likely get the following error: 

```php
Message: mysqli::real_connect(): The server requested authentication method unknown to the client [caching_sha2_password]
```

To fix this use one of the following sql commands under your schema shelterenterprise:

```sql
ALTER USER 'mysqlUsername'@'localhost' 
IDENTIFIED WITH mysql_native_password 
BY 'mysqlUsernamePassword';
```

or if you are creating a user for the database:

```sql
 CREATE USER 'jeffrey'@'localhost' 
 IDENTIFIED WITH mysql_native_password 
 BY 'password';
```

{==TODO==}


## Site Configuration
At this point you have configured your environment for development and are sitting at the login screen. However there 
are no registered users in the site currently. Run the following in your SQL command line under the shelterenterprise 
schema:

TODO: Update this to work with the current users structure
```mysql
## Creates the groups needed for the application
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1,'admin','Administrator'),
(2,'members','General User');

## Creates an admin user to login as
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`,`activation_code`, `created_on`) VALUES
('1','127.0.0.1','admin','$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa','','1268889823');

## Adds the admin user to the general user group and the admin group
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1,1,1),
(2,1,2);

```
{==TODO: Finish the SQL command above==}

Now refresh the page and you will be able to log in as 

```
username: admin
password: password
```

and you are ready to develop on the shelter enterprise supply chain management application! 
