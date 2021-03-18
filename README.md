
## User Registration & Login System Features
* Connecting MySQL backend database with PHPmyAdmin
* Building user registration form with Bootstrap
* PHP server-side validation
* Handling error messages
* Securely hash password
* Sending verification mail with SwiftMailer

To send the verification mail to the user, We need to install the SwiftMailer php plugin
We used the following composer command to install the SwiftMailer library.
(composer require "swiftmailer/swiftmailer:^6.0")

Composer should be installed on the development machine.

## Login System
* Build login form with Bootstrap
* Password verification
* Storing data in session
* Allowing access to only verified users
* Display user data to logged-in users
* Building logout

## External Database

We created an external database that can be accessed by the everyone. Follow these instructions to connect to the Database

Go to the following web address:
> [http://ssd.ennio.co.uk/](http://ssd.ennio.co.uk/)

When prompted, log in with these credentials:

__Username__

`ssd-cwk1-bae`

__Password__

`luwandagga`

### Generate your own local database

If you want to generate your own local database, follow these steps

* Open your phpMyAdmin and execute the SQL script found in bae.sql
* Uncomment lines 18-20 in /config/db.php

## Available users

You can create your own users, but if you want to access the existent accounts here's the credentials

| Username                   | Password      |
|----------------------------|---------------|
| ennio@ennio.co.uk          | FrozenShit69! |
| luwandaggabright@gmail.com | Bright@1234   |
