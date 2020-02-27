# AFROTC Detachment 550 Cadet Website
Fork of MITR project website that was built to track and simply ROTC life. This site tracks ROTC attendance and provides a centrailized communication system.

## Attendance
TODO

## Users 
TODO

## Admin Functions
TODO


## Access the cPanel database
First you have to go the cPanel site 'https://union.rpi.edu:2083/' where you can log in with the following credentials:
```
Username: afrotcdev
Password: P-l@Fe$nq6z-
```
You will then have access to all of the back end side of the website.


## Connecting Filezilla to upload files to cPanel
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

## Editing Wiki Pages 
To edit wiki pages, first you must install Python 3.8 and mkdocs theme.
Open Command Prompt. 
Cd into the directory of the .MD file you want to edit.
Enter mkdocs serve into the command prompt.
If you get an error along the lines of ".yml file is missing," type mkdocs new (enter in filepath) and try again.
Go to Localhost:8000 to get a live preview of the page.
Change the text in an IDE and see the results live in a browser tab. 