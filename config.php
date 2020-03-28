<?php
$dsn = 'mysql:host=localhost;dbname=bookshopdb;charset=utf8';
$username = 'root';
$password = '';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
// echo "ok"; 
} catch(PDOException $e) {

}
