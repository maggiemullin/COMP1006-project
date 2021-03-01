<?php
try{

    $dsn = 'mysql:host=localhost;dbname=COMP1006';
    $username = 'root';
    $password = 'root'; //mamp users

    $db = new PDO($dsn, $username, $password);
    //echo "<p> Successfully connected </p>";
}
catch(PDOException $e){
    echo "<p> Something went wrong </p>";
    $error_message = $e->getMessage();
    echo $error_message;

}


?>