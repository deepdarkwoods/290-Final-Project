<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');
?>

<!DOCTYPE html>
<html lang="en-US">
<html>
<head>
    <title>Vehicle Expense Tracker</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" media="all" href="style.css">
</head>
<body>
    
<header>
  <img id="sitelogo" src="images/carlogo.jpg"><br>
    Vehicle Expense Tracker
   
</header>
<nav>  New Account
  
</nav>

<section>
  <h1>Create New Account</h1><br>
  Choose a Username and Password:
 
        <form  method="post" action="newaccount.php">
            <p><input id="loginuser" type="text" name="login" value="" placeholder="Username" required onchange=checkUsername() ></p>
            <p><input type="password" name="password" value="" placeholder="Password" required></p>
            <p><input  type="submit" name="newAccount" value="Create Account" ></p> </p>
        </form>
        <div id="ajaxcheck"> </div>
</section>
    
 

<footer>
  Email: Brad Parker parkerb@@onid.oregonstate.edu  Copyright &#64 2015 BP Designs
  <script type="text/javascript" src="pajax.js"></script>
</footer>

</body>
</html> 


<?php
if(isset($_POST["newAccount"]))
    {
        $servername = "localhost";
        $username = "brad";
        $password = "brad";
        $dbname = "tracker";

        $conn = new mysqli($servername, $username, $password, $dbname);
        $q = $_POST['login'];
                            
        $stmt = $conn->prepare("SELECT * FROM users WHERE username =?");
        $stmt->bind_param("s",$q);
        $stmt->execute();
        
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $conn->close();  
    
    //if username doesn't exit[no returned results]
   if($row)
        {
               echo "<script>document.getElementById('ajaxcheck').innerHTML='Username NOT ACCEPTED, Try Again.'</script>";
               return;
                 
            
        }        
        else        
        {           
            echo "<script>document.getElementById('ajaxcheck').innerHTML='Congratulations ! UserName is Accepted.'</script>";
            
            $newUSERNAME = $_POST['login'];
            $newPASSWORD = $_POST['password'];
            
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
                    $stmt = $conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
                    $stmt->bind_param("ss",$newUSERNAME,$newPASSWORD);
                    $stmt->execute();
                    
                   
                }          
                
                
          
        }       
         
    }
                 
                 
                 
  
    
 

?>
