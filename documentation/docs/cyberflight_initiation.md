## Welcome to Det550's Cyber Flight!

#### In order to first begin we must first download a few things

 - [PHPStorm](https://www.jetbrains.com/phpstorm/download/#section=windows) - This is the development enviornment we will use to edit the website code. 
 - [MySQL](https://dev.mysql.com/downloads/installer/)
 - [Github](https://github.com/)
 - [FileZilla](https://filezilla-project.org/) - This is a tool for sending your files to the live site.
 - [XAMPP](https://www.apachefriends.org/index.html) - This is Voodoo magic that will make everything work somehow. TTP.



### XAMPP Set Up
1. Start Apache  -To run LocalHost only-
2. Open Files
3. Open htdocs
4. Copy and paste your repository into htdocs folder
5. Delete other stuff
6. open config.php inside htdocs with PHPStorm
7. Edit out ':8080' from "localhost:8080"
9. Open application tab in PHPStorm
10. Delete ".htaccess"


### PHPStorm Setup


#### Local PHP Configuration
1. Download the latest version of php at the following link: [PHP Download](https://windows.php.net/download/)
2. Extract the zip folder to a folder where you'd like to store PHP. 
3. Go in this folder and find the file titled 'php.ini - development' and create a new document in the same directory called 
php.ini. This will be the configuration settings file of your local PHP environment.
4. Edit this file and uncomment the following line:
```php
extension_dir = "ext"
```
this allows the computer to find the extensions 
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

#### Setting up your repository

 1. Click on "Get from Version Control"
 2. Click on Github (or log in if it asks you to do so)
 3. Select the current master branch
 4. Directory should look for:

        C:\xampp\htdocs




### Pushing Changes to Det550.com with FileZilla


 - Open FileZilla
 - Click on "Open the Site Manager" button in the top left corner

#### General
```
Protocol: SFTP - SSH File Transfer Protocol
Host: Det550.com
Logon Type: Normal
User: g7afzsg72ror
Password: F@lcons550
```

#### Advanced
```
Server type: Default
Default local directory: C:\xampp2\htdocs\
Default remote directory: /home/g7afzsg72ror/public_html
Use synchronized browsing
Use Directory comparison
No server time offset
```

#### Transfer Settings
```
DO NOT Limit number of simultaneous connections
Maximum number of connections should be set to 1
```

#### Charset
```
Autodetect
```

#### How to Use

 - Click Connect after opening the Site Manager
 - Drag only the files you uploaded to the main branch of the website over to the server side
 - Don't touch anything else





### MySQL
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




