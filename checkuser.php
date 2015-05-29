<?php

//checks the database TABLE 'users' to see if username exits
//general usage take from online sournce: W3Schools
$q = $_GET['username'];

$servername = "oniddb.cws.oregonstate.edu";
$username = "parkerb2-db";
$password = "RznqNou9jGnYkUSh";
$dbname = "parkerb2-db";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn)
    {
        die('Could not connect: ' . mysqli_error($conn));
    }
else
    {        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username =?");
        $stmt->bind_param("s",$q);
        $stmt->execute();
        
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
    
    //if username doesn't exit[no returned results]
   if(!$row)
        {
            echo "Valid UserName!";      
            
        }        
        else        
        {           
            echo "<p style='color:red' >Sorry, UserName has been taken. Enter another.</p>";
          
        }       
        $conn->close();   
    }
?>



