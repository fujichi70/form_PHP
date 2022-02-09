<?php 

const DB_HOST = 'mysql:dbname=form;host=127.0.0.1;charset=utf8';
const DB_USER = 'root';
const DB_PASSWORD = '';


try{
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch(PDOException $e) {
    exit();
}

?>