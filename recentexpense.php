<?php
session_start();
$un=$_SESSION['user'];

            $servername = "localhost";
            $username = "brad";
            $password = "brad";
            $dbname = "tracker";
    
            $conn = new mysqli($servername, $username, $password, $dbname);

            $records = $conn->query("SELECT * FROM expenses WHERE id='$un'");
            while($row = $records->fetch_assoc())    
                {
                    echo "{$row['description']} ";
                }






?>