<?php 
define('db_host','localhost');
define('db_username','root');
define('db_password','');
define('db_name','db_letea');

$connection = mysqli_connect('db_host','db_username','db_password','db_name');

if(!$connection){
    die('Could not Connect to MySQL Database' . mysqli_error_() );
}