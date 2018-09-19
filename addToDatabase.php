<?php

   include_once('DatabaseConnection.php');

    if($conn == false)
	{
		die("ERROR: ".mysqli_connect_error());
	}
    else
    {

            if (!empty($_POST['email']) && !empty($_POST['nam']) && !empty($_POST['comment']) && !preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/',$_POST['email']) && !preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/',$_POST['nam']) && !preg_match('/[\'^£$%&*()}{#~?><>,|=_+¬-]/',$_POST['comment']))
            {
            $id = $_POST['id'];
            $email = $_POST['email'];
            $name = $_POST['nam'];
            $comment = $_POST['comment'];
            $tableName = $_POST['tab'];
            $insertToDatabase = "INSERT INTO `$tableName` (id, name, email, comment, date) VALUES (NULL, '".$name."', '".$email."', '".$comment."', now())";
            $insertToDatabase2 = "INSERT INTO `$tableName` (id, name, email, comment, first_level_id, date) VALUES (NULL, '".$name."', '".$email."', '".$comment."', '".$id."', now())";

            if (mysqli_select_db($conn, $dbName)) {
	           if ($conn->query($insertToDatabase2) || $conn->query($insertToDatabase)) {
			     echo("<script> alert('Komentaras pridetas'); </script>");
	           }
            }
            }

        }
?>
