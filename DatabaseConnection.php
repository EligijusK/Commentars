<?php

    $dbServer = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "komentarai";
    $db = mysqli_connect($dbServer, $dbUsername, $dbPassword);
	$conn = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);
    if($conn == false && $db == true)
    {
        $sql = "CREATE DATABASE komentarai";
        if($db->query($sql) === true)
        {
            $first = "CREATE TABLE first_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), date TIMESTAMP)";
            $second = "CREATE TABLE second_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), first_level_id INT(9), date TIMESTAMP)";
            if($db->query($first) === true && $db->query($second) === true)
            {
                echo("Created Full Database");
            }
        }
    }
    else if($conn == true)
    {
        $check1 = $conn->Query("SELECT 1 FROM first_level");
        $check2 = $conn->Query("SELECT 1 FROM second_level");
        if($check1 === false && $check2 === false )
        {
            $first = "CREATE TABLE first_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), date TIMESTAMP)";
            $second = "CREATE TABLE second_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), first_level_id INT(9), date TIMESTAMP)";
            $conn->query($first);
            $conn->query($second);
        }
        else if($check1 === true && $check2 === false)
        {
            $second = "CREATE TABLE second_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), first_level_id INT(9), date TIMESTAMP)";
            $conn->query($second);
        }
        else if( $check2 === true && $check1 === true )
        {
            $first = "CREATE TABLE first_level ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(50), comment VARCHAR(50), date TIMESTAMP)";
            $conn->query($first);
        }

    }

?>
