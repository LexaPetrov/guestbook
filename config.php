<?php
session_start();
define("HOST", "localhost:3307");
define("USER", "root");
define("PASSWORD", "");
define("DBNAME", "gbook");
define("CHARSET", "utf8");
define("SALT", "qwertyUIOP");


$dsn = "mysql:host=".HOST.";dbname=".DBNAME.";charset="
.CHARSET;
try {
	$dbConn = new PDO($dsn, USER, PASSWORD);
} catch (PDOException $e) {
	die('Не подключился: ' . $e->getMessage());
}