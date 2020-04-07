This site is a fork of MITR project website that was built to track and simply ROTC life. This site tracks ROTC 
attendance and provides a centralized communication system.

## Technology Used
- [Bootstrap Select](https://developer.snapappointments.com/bootstrap-select/): Used for the searchable drop downs
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
- [MkDocs](https://www.mkdocs.org/): Used to create the html for the documentation from the Markdown
- [MkDocs Material Theme](https://github.com/squidfunk/mkdocs-material): Used to give a theme to the documentation
- [Python MkDocs Extension](https://squidfunk.github.io/mkdocs-material/extensions/pymdown/): Gives you added features 
for the styling of the documentation

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

## Digital Ocean Development Set Up

To configure and run the site from digital ocean follow these steps:

1. Install the docker application from the [Docker Site](https://docs.docker.com/install/)

2. Then you will navigate to the location you would like to run the site from in your terminal. Here you will use the 
following bash commands: 

    ```bash
    mkdir ~/afrotc_site && cd ~/afrotc_site
    curl -LO https://raw.githubusercontent.com/bitnami/bitnami-docker-codeigniter/master/docker-compose.yml
    docker-compose up
    ```

    Once you run these commands it you will have a running instance of docker on localhost. You will need to look at the 
    generated docker-compose.yml file to check which port this site is running on. Then you can test the site is running by
    navigating to localhost:{The Port In the YAML File} in your browser.

3. Now create a folder called myapp inside the afrotc_site directory you created.

4. Next you will need to move the site code into this folder. To do this you will need to download the code from the 
[Det 550 Repository](https://github.com/jmessare46/det550website.git) and move that code to the myapp folder you 
created.

5. We need to install MYSQL on your docker instance to do so run the following:

    ```bash
    docker pull mysql:8.0.1
    docker run --name my-own-mysql -e MYSQL_ROOT_PASSWORD={enter a password} -d mysql:8.0.1
    ```

6. We also need to install PhpMyAdmin on your docker instance to do so run the following:

    ```bash
    docker pull phpmyadmin/phpmyadmin:latest
    docker run --name my-own-phpmyadmin -d --link my-own-mysql:db -p 8081:80 phpmyadmin/phpmyadmin
    ```

7. Now update the docker-compose.yml file located where you first created the myapp folder. Use the below settings in your docker-compose.yml file:

    ```yaml
     version: '2'
        services:
          myapp:
            image: 'bitnami/codeigniter:3.1.11'
            environment:
              - CODEIGNITER_PROJECT_NAME=myapp
            ports:
              - '8000:8000'
            volumes:
              - '.:/app'
            depends_on:
              - mysql
              - phpmyadmin
          phpmyadmin:
            image: phpmyadmin/phpmyadmin:latest
            ports:
              - '8181:80'
            environment:
              - PMA_ARBITRARY=1
              - PMA_HOST=mysql
              - PMA_VERBOSE=mysql
              - PMA_USER=root
              - PMA_PASSWORD=Mess1998
            depends_on:
              - mysql
          mysql:
            image: 'mysql:8.0.1'
            environment:
                - MYSQL_ROOT_PASSWORD=Mess1998
    ``` 

8. Once these changes are saved run:

    ```bash 
    docker-compose up
    ```

    Your site should now be running at localhost:8000. You will now need to instantiate the database with some fake data to 
    use for development. 

9. Your PhpMyAdmin instance (a visual representation of MySQL) will be located at localhost:8181. Use the [Developer 
Database](./../../sql/developer_data_dump.sql) dump file to upload the fake data to your phpmyadmin.

    1. First click the new button in the top right and create a database named 'afrotc_mitr'.
    2. Click on this database.
    3. Click the 'Import' button.
    4. Choose the [Developer Database](./../../sql/developer_data_dump.sql) file. 
    5. Click the 'go' button and all of the database will have been uploaded.

10. Finally, you may have to modify the code you got from the repository to connect to your database. Enter the password
that you provided when installin MySQL above in the [database.php](../../application/config/database.php) file. Make 
sure you config file contains the following: 

        $db['default'] = array(
            'dsn'	=> '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '{your MySQL password}',
            'database' => 'afrotc_mitr',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );

    That's it you should be ready to develop. Just use the below docker command while in the directory you built to run the 
    site.

    ```bash
    docker-compose up
    ```
    
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
