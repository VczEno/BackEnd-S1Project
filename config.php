<?php

    $config = [
        'mysql_host' => 'localhost',
        'mysql_user' => 'root',
        'mysql_password' => ''
    ];
//creo l'oggetto che mi permetterà di interagire con il DB
$mysqli = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password']);
if ($mysqli->connect_error) {die($mysqli->connect_error);};

// creo una variabile d'appoggio per le istruzioni SQL
$sql= 'CREATE DATABASE IF NOT EXISTS whatarecord;';
if(!$mysqli->query($sql)) {die($mysqli->connect_error);}; //prassi comune usare un if per interrompere l'esecuzione dello script in caso di errore

$sql = 'USE whatarecord'; 
if (!$mysqli->query($sql)) {die($mysqli->connect_error);};

//creo la tabella
$sql= 'CREATE TABLE IF NOT EXISTS albums (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    year INT UNSIGNED NOT NULL,
    genre VARCHAR(255) NOT NULL,
    cover VARCHAR(255)
    )';
if (!$mysqli->query($sql)) {die($mysqli->connect_error);};