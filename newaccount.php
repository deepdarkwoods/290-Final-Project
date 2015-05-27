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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Main Container Class -->
<div class="container-fluid">
<!-- Top Span -->
    <div class="row">
        <div class="col-sm-4"><h6></h6><a href="index.html"><img src="images/carlogo.jpg" alt="Vehicle Expense Tracker Home" width="80" height="30" border="0"></a></h6></div>
        <div class="col-sm-4"><h6>Vehicle Expense Tracker</h6></div>
        <div class="col-sm-4"><h6>a BP Factory App</h6></div>       
    </div>
    
<!-- Message to User -->
    <div class="jumbotron">
        <section>
            <h3>You're on your way !</h3><br>
            <p>
            Start with a unique Username and Pasword.
            </p>          
        </section>
    </div>

<!-- New Username Password -->
    <nav class="navbar navbar-default">        
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
    //Add user to Database
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
        
                    //check if username exists
       if($row)
            {       //username already taken, reject entry
                   echo "<script>document.getElementById('ajaxcheck').innerHTML='<p style=color:red>Username NOT ACCEPTED, Try Again.</p>'</script>";
                   return;            
            }        
        else        
            {
                    //username does not exist, add username and password to database
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
                        
                        //submit form and give user a link to setup their page
                        echo  "<form  method='post' action='profile.php'>";
                        echo  "<p><input type='hidden' name='login' value=$newUSERNAME></p>";
                        echo  "<p><input type='hidden' name='password' value=$newPASSWORD ></p>";
                        echo  "<p><input  type='submit' name='gotoAccount' value='Setup Account' ></p>";
                        echo  "</form>";
                           
                    }      
            }       
        }
    
    ?>
<!-- Footer -->
    <div class="panel panel-default">
        <footer>
          Email: Brad Parker parkerb@@onid.oregonstate.edu  <br> Copyright &#64 2015 BP Designs
        <script type="text/javascript" src="pajax.js"></script>
        </footer>
    </div>
    
</div>
</body>
</html> 