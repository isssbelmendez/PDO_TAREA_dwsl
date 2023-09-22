<?php
$hostname = "localhost";  
$username = "root"; 
$password = "";
$database_name = "db_resultado"; 

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($pdo)
    {
        echo "Listo";
    }else
    {
        echo "Fallo la conexion";
    }

}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>