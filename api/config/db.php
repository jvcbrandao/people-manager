<?php

$host = 'localhost';
$dbname = 'people_manager_db';
$user = 'root';
$password = 'root';


try {
    $conn = new PDO('', $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo ''. $e->getMessage();
    exit;
}