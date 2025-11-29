<?php

$host = 'localhost';
$dbname = 'people_manager_db';
$user = 'root';
$password = 'root';

// DSN = Data Source Name (onde está o banco, qual driver, qual base etc.)
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,          // lança exceção em erro
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // fetch em array associativo por padrão
    ]);
} catch (PDOException $e) {
    echo 'Erro ao conectar ao banco: ' . $e->getMessage();
    exit;
}