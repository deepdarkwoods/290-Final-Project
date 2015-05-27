<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

//assign a session variable to maintain state
if(isset($_POST["login"]))
    {
    $_SESSION["user"]= $_POST["login"];    
    }
//assign a session variable to maintain state
if(!isset($_SESSION['user']))
   {
    header("Location:index.html");
   }
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

<!--Main Container-->
<div class="container-fluid">     
    <div class="row">
        <div class="col-sm-4"><h6></h6><a href="index.html"><img src="images/carlogo.jpg" alt="Vehicle Expense Tracker Home" width="80" height="30" border="0"></a></h6></div>
        <div class="col-sm-4"><h6>Vehicle Expense Tracker</h6></div>
        <div class="col-sm-4"><h6>a BP Factory App</h6></div>       
    </div>
   
<!--Enter Vehicle Info-->  
    <nav class="navbar navbar-default">  Enter Vehicle Info:      
        <div class="jumbotron">      
          <h3>Keep Going !</h3><br>  
        </div>    
        <form  method="post" action="profile.php">
            <p><input type="text" name="make" value="" placeholder="Make" required ></p>
            <p><input type="text" name="model" value="" placeholder="Model" required></p>
            <p><input id="yearcheck" type="text" name="year" value="" placeholder="4 digit Year" required onchange=checkyear()></p>
            <p><input type="text" name="description" value="" placeholder="Description" required></p>
            <p><input id="vehicleinput" type="submit" name="vehicleadd" value="Enter Vehicle" ></p> 
        </form>
            <!--Fill Empty Grid-->
            <div id="error"> </div>
    </nav>
      
<?php

//add vehicle information to profile
if(isset($_POST["vehicleadd"]) && is_numeric($_POST["year"]) && (strlen($_POST["year"]) ==4))
    {
        
            $newMAKE = $_POST['make'];
            $newMODEL = $_POST['model'];
            $newYEAR = $_POST['year'];
            $newDESC = $_POST['description'];            
            
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
                {   $id = $_SESSION['user'];
                    
                    $stmt = $conn->prepare("UPDATE users SET make=?,model=?,year=?,description=? WHERE username = ?");
                    $stmt->bind_param("ssiss",$newMAKE,$newMODEL,$newYEAR,$newDESC,$id);
                    $stmt->execute();
                    
                    echo "<script>document.getElementById('vehicleinput').style.display = 'none'</script>";
                    
                    echo  "<form  method='post' action='homepage.php'>";
                    echo  "<p><input type='hidden' name='login' value=$id></p>";
                    echo  "<p><input  type='submit' name='gotoAccount' value='Go To My HomePage' ></p>";
                    echo  "</form>";
                    
        
                }

    }




?>
        
    <footer>
    Email: Brad Parker parkerb@onid.oregonstate.edu  Copyright &#64 2015 BP Designs
    <script type="text/javascript" src="pajax.js"></script>
    </footer>
</div>
</body>
</html>      
       
       