<?php

$dsn = 'mysql:host=localhost;dbname=my blog';
$user = 'root';
$pass = '';
$option = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
];

try {
    $conf = new PDO($dsn, $user, $pass, $option);
    $conf->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Failed To Connect' . $e->getMessage();
}
