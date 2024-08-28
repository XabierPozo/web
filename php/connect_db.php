<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=user_log", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "<div class='connect'>";
        echo "Connection failed: " . $e->getMessage();
        echo "</div>";
    }
?>
