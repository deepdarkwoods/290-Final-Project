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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>

<div class="container-fluid">     
   <div class="row">
        <div class="col-sm-4"><h6></h6><a href="index.html"><img src="images/carlogo.jpg" alt="Vehicle Expense Tracker Home" width="80" height="30" border="0"></a></h6></div>
        <div class="col-sm-4"><h6>Vehicle Expense Tracker</h6></div>
        <div class="col-sm-4"><h6>a BP Factory App</h6></div>       
    </div>
    <div class="jumbotron">
        <section>
          <h3>You're on your way !</h3><br>
            <p>
            Start with a unique Username and Pasword.
            </p>
          
        </section>
    </div>

    <nav class="navbar navbar-default">
                
        <section>
          <h1>Create New Account</h1><br>
          Choose a Username and Password:         
                <form  method="post" action="newaccount.php">
                    <p><input id="loginuser" type="text" name="login" value="" placeholder="Username" required onchange=checkUsername() ></p>
                    <p><input type="password" name="password" value="" placeholder="Password" required></p>
                    <p><input  type="submit" name="newAccount" value="Create Account" ></p> </p>
                </form>
                <div id="ajaxcheck"> </div>
    </nav>           
    
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
                        
                       
                        echo  "<form  method='post' action='profile.php'>";
                        echo  "<p><input type='hidden' name='login' value=$newUSERNAME></p>";
                        echo  "<p><input type='hidden' name='password' value=$newPASSWORD ></p>";
                        echo  "<p><input  type='submit' name='gotoAccount' value='Setup Account' ></p>";
                        echo  "</form>";
                       
                    }          
                    
                    
              
            }       
             
        }
    
    ?>
    </section>
        
     
    
    <div class="panel panel-default">
        <footer>
          Email: Brad Parker parkerb@@onid.oregonstate.edu  <br> Copyright &#64 2015 BP Designs
        <script type="text/javascript" src="pajax.js"></script>
        </footer>
    </div>
</div>
</body>
</html> 