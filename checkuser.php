<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');



//checks the database TABLE 'users' to see if username exits
//general usage take from online sournce: W3Schools
$q = $_GET['username'];

$servername = "localhost";
$username = "brad";
$password = "brad";
$dbname = "tracker";

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



