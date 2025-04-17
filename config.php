<?php
$dsn = "mysql:dbname=sistemacomentario;host=localhost";
$dbname = "root";
$dbpass = "";

try {
$pdo = new PDO($dsn, $dbname, $dbpass);
} catch(PDOException $e){
  echo "error ".$e->getMessage();
}