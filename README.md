# Famous Stylists Hair Salon

#### Simple app allowing the user to view, add, edit, and delete clients and stylists at a fictitious hair salon.

#### By Nicole Freed

## Description

Simple app allowing the user to view, add, edit, and delete clients and stylists at a fictitious hair salon. The app also displays a list of clients for a given stylist when the stylist's name is clicked.s

## Setup/Installation Requirements

* You'll need to have PHP installed on your computer. For install instructions, see https://www.learnhowtoprogram.com/php/getting-started-with-php/installing-php.
* Clone the project directory from Terminal using `git clone https://github.com/gitasong/address-book-twig.git`.
* Unzip the project directory.
* Install Composer on your computer following the install instructions:
    * Mac: https://www.learnhowtoprogram.com/php/getting-started-with-php/installing-composer-and-configuration-for-mac
    * Windows: https://www.learnhowtoprogram.com/php/getting-started-with-php/installing-composer-and-configuration-for-windows for Windows.
* In Terminal, navigate to the main project directory and install the necessary dependencies (Silex and Twig) using `composer install`.
* In Terminal, navigate to the web folder inside the main project directory and start your PHP server using `php -S localhost:8000`.
* Type `localhost:8000` in your browser URL window to start the app.
* To view and edit the database:
    * Open MAMP. Click on `Preferences > Ports` tab and set the Apache port to 8888 and the MySQL port to 8889.
    * In MAMP, click `Open WebStart page`. The MAMP WebStart page will open in your browser.
    * Click on the Tools dropdown menu at the top of the WebStart page and choose phpMyAdmin.
    * Once phpMyAdmin opens in your web browser, click the `Import` tab > `Browse` button and navigate to the `hair_salon.sql` file in the project directory.
* MySQL commands to recreate hair_salon database:
    * `CREATE DATABASE hair_salon`
    * `USE hair_salon`
    * `CREATE TABLE stylists (name VARCHAR (255), id serial PRIMARY KEY);`
    * `CREATE TABLE clients (name VARCHAR (255), stylist_id INT, id serial PRIMARY KEY);`

## Known Bugs

Adding a client without choosing a stylist from the dropdown will return an error.

## Support and contact details

You can contact me at gitasong@github.io.

## Technologies Used

* PHP 5.6
* HTML 5
* Silex 1.1
* Twig 1.0
* Composer
* MAMP 4.1.1
* Apache server
* PHPUnit 4.5.x (for testing)
* MySQL 5.6.35
* phpMyAdmin

### License

This app is licensed under the MIT license.

Copyright (c) 2016 Nicole Freed
