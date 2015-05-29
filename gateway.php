<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

            $userid=$_POST["login"];
            $pword=$_POST["password"];
            
              
            
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
                   
                  
                 
                   if(!$row)
                        {
                               header('Location: index.html');     
                          
                        }
                    else
                        {
                                $_SESSION['user']=$userid;
                                header('Location: homepage.php');
                                
                        }
                        
                        
                        
                }
                
                $conn->close();
?>

























