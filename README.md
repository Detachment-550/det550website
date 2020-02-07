# AFROTC Detachment 550 Cadet Website
Fork of [MITR project website](https://github.com/tans2/mitr-group-4) that was built to track and simply ROTC life. This site tracks ROTC attendance and provides a centrailized communication system.

A special thanks goes out to the following for starting this project:
   - [Andrew Son](https://github.com/sonj2)
   - [Jon Gay](https://github.com/jtgjohn)
   - [Stephanie Tan](https://github.com/tans2)

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
   
   Username: g7afzsg72ror
   Password: F@lcons550
