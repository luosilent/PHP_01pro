<?php

$hostname = 'localhost';
$dbname = 'dtest';
$dbuser = 'root';
$dbpwd = 'root';
$dsn = 'mysql:host=' . $hostname . ';dbname=' . $dbname;

$pdo = new PDO( $dsn, $dbuser, $dbpwd) or die("连接失败!");
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->exec( "SET NAMES utf8" );

require_once 'functions.php';