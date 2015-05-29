<?php


            $userid=$_GET["userid"];
            $pword=$_GET["pass"];
            
              
            
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
                    
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
                    $stmt->bind_param("ss",$userid,$pword); 
                    $stmt->execute();
                    
                    
                    $res = $stmt->get_result();
                    $row = $res->fetch_assoc();
                   
                  
                    //if username doesn't exit[no returned results]
                   if(!$row)
                        {
                               echo "<p style='color:red' >Incorrect Username or Password</p>";                  
                        }        
                }
                
                $conn->close();
?>

























