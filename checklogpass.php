<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

            $userid=$_GET["userid"];
            $pword=$_GET["pass"];
            
              
            
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
                    
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
                    $stmt->bind_param("ss",$userid,$pword); 
                    $stmt->execute();
                    
                    
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                   
                  
                    //if username doesn't exit[no returned results]
                   if(!$row)
                        {
                               echo "Incorrect Username or Password";      
                          
                        }        
                }
                
                $conn->close();
?>

























