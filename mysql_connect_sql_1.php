<?php
$user = 'root';
$password ='';
$db ='sql_testing';
$host = 'localhost';

$dsn ='mysql:host ='.$host.';dbname='.$db;
$pdo = new PDO($dsn, $user, $password);
 ?>
