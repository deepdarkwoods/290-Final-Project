<?php
session_start();
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
<div class="container-fluid">   
   <div class="row">
        <div class="col-sm-4"><h6></h6><a href="index.html"><img src="images/carlogo.jpg" alt="Vehicle Expense Tracker Home" width="80" height="30" border="0"></a></h6></div>
        <div class="col-sm-4"><h6>Vehicle Expense Tracker</h6></div>
        <div class="col-sm-4"><h6>a BP Factory App</h6></div>       
    </div>
    <nav class="navbar navbar-default">
        <?php
         echo "Active User: $_SESSION[user]";
        ?>
        <form method="post" action="logout.php">
            <p class="submit"><input type="submit" name="out" value="Logout"></p>
        </form> 
    
    
    <div class="row">
    <div class="col-sm-6"><h3>Add Expense</h3>
    </div>
    <div class="col-sm-6"><h3>Most Recent Expenses</h3>
    </div>
    
    </div>
     <div class="row">
        <div class="col-sm-6">
            <form id="expenseform" method="post" action="homepage.php" >
                <input type="date" name="date" value="" placeholder="Date"  style="height:20px;" required>
                <select id="costtype" name="typeofcost" style="height:20px;" onchange=checkfuel()>
                <option value="maint">Maintance</option>
                <option value="fuel">Fuel</option>                
                <option value="repair">Repair</option>
                <option value="misc">Misc</option>                
                </select>
                <input type="text" name="description" value="" placeholder="Description" size="30" style="height:20px;" required>
                <input type="text" name="mileage" value="" placeholder="Mileage"size="7" style="height:20px;" required>
                $<input type="text" name="cost" value="" placeholder="Cost" size="8" onchange=showexpenses() style="height:20px;" required>
                <input type="submit" name="push" value="Submit" >
            </form>
                
        </div>
        <div id="showRecentExp" class="col-sm-6">List of Expenses here
    
        
        
        </div>
             
    </div> 
     
    </nav>
    
    <section>
    
      
    </section>
        
        
     
    
    
    
    <footer>
      Email: Brad Parker parkerb@@onid.oregonstate.edu  Copyright &#64 2015 BP Designs
    <script type="text/javascript" src="pajax.js"></script>
    </footer>
</div>
</body>
</html>

<?php


$un=$_SESSION['user'];

$ga="";
$ppg="";
    
if(isset($_POST["push"]))
    {
        $tc=$_POST["typeofcost"];
        $dc=$_POST["description"];
        $mg=$_POST["mileage"];
        $co=$_POST["cost"];
        $da=$_POST["date"];
        if(isset($_POST["gallons"]))
            {
                $ga=$_POST["gallons"];
                if($ga >0)
                {$ppg=$co/$ga;}
            }
           
    
    }

            $servername = "localhost";
            $username = "brad";
            $password = "brad";
            $dbname = "tracker";
    
            $conn = new mysqli($servername, $username, $password, $dbname);
            $stmt = $conn->prepare("INSERT INTO expenses (date,id,category,cost,description,mileage,gallons,ppg) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssdsiid",$da,$un,$tc,$co,$dc,$mg,$ga,$ppg);
            $stmt->execute();
            $conn->close();

?>









