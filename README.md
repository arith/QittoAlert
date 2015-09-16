Quickstart
==========
Clone this repository:-

    git clone https://github.com/jomwebjohor/QittoAlert.git


Get into the directory and edit `config.php`:-

    cd QittoAlert
    vim config.php

Set your MySQL credentials:-

    /*** mysql hostname ***/
    $hostname = 'localhost';

    /*** mysql username ***/
    $username = 'root';

    /*** mysql password ***/
    $password = 'abc123';

Load the initial data

    mysql -u root -p < denggi.sql

Run the development server:-

    php -S 127.0.0.1:8000 

You can now access it via web browser at http://localhost:8000/.

<img src="http://i.imgur.com/NxyMEHK.png"></img>
