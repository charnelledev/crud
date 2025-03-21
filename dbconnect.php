<?php
try{

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'crud';
    // Create connection
    
    $pdo=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    // Check connection
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}





