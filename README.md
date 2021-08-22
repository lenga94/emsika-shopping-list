<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# emsika-todo-app
This is the basic to-do app with authentication created as a part of emsika challenge

# Installation
Make sure composer is installed in your system(your local computer or server)

Now clone this app by running this command =><b> git clone https://github.com/lenga94/emsika-shopping-list.git</b>
Or you can simply download zip file and unzip it.

Now go inside the folder and using console, run composer by executing => <b>composer install</b>
Now run using cmd => <b>cp .env.example .env</b>
Now edit .env file :
<h3>Replace below lines</h3>
<i><br/>
 DB_CONNECTION=mysql<br/>
 DB_HOST=127.0.0.1<br/>
 DB_PORT=3306<br/>
 DB_DATABASE=todo_app_db<br/>
 DB_USERNAME=root<br/>
 DB_PASSWORD= </i>

<h3>With this</h3>
<i>DB_CONNECTION=sqlite</i>

Now go to database folder and create a new file named <b>database.sqlite</b> (see the extension, it should be .sqlite not .txt)

Then run => <b>php artisan migrate</b>

Lastly generate the app key by running => <b>php artisan key:generate</p>

