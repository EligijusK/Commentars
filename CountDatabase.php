<?php

include_once("DatabaseConnection.php");

    $sql1 = "SELECT * FROM `first_level`";
    $sql2 = "SELECT * FROM `second_level`";
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        $data1 = mysqli_num_rows($result1);
        $data2 = mysqli_num_rows($result2);
        header('Content-Type: application/json');
        echo json_encode(array('first' => $data1, 'second' => $data2));

?>
