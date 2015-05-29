<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');



//check if user has logged in
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
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body onload="showexpenses()" >
    
<!--Main Container-->
<div class="container-fluid">    
    <div class="row">
         <div class="col-sm-4"><h6></h6><a href="index.html"><img src="images/carlogo.jpg" alt="Vehicle Expense Tracker Home" width="80" height="30" border="0"></a></h6></div>
         <div class="col-sm-4"><h6>Vehicle Expense Tracker</h6></div>
         <div class="col-sm-4"><h6>a BP Factory App</h6></div>       
    </div>

<!--Main Container--> 
    <nav class="navbar navbar-default">
<?php
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "parkerb2-db";
            $password = "RznqNou9jGnYkUSh";
            $dbname = "parkerb2-db";
    
            $uconnect = new mysqli($servername, $username, $password, $dbname);
            
           
            $uresult = $uconnect->query("SELECT * FROM users WHERE username=('$_SESSION[user]')"); 
            $show = $uresult->fetch_object();
            
            echo "<h3>Hello: " . $show->username . "    </h3>";
            echo "     <strong>Vehicle Info:</strong> ";
            echo "     <strong>Make: </strong>" . $show->make;
            echo "     <strong>Model:</strong> " . $show->model;
            echo "     <strong>Year:</strong> " . $show->year;
            echo "     <strong>Description:</strong> " . $show->description;
          
          
?>
         <form method="post" action="logout.php">
             <p class="submit"><input type="submit" name="out" value="Logout"></p>
         </form> 
      </nav>
     
     <div class="row">
     <div class="col-sm-6"><h3>Add Expense</h3></div>
     <div class="col-sm-6"><h3>Lowest Gas Prices in your area</h3></div>     
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
                 $<input type="text" name="cost" value="" placeholder="Cost" size="8"  style="height:20px;" required>
                 <p id="belowtotalcost"></p>
                 <input type="submit" name="push" value="Submit" >               
             </form>                
         </div>
         <div class="col-sm-6">
            <button type="button" onclick="lookupGeoData();">Find Where You live. Hit 'Return Data'</button>
            <button type="button" onclick="searchGas();">Show Me the Lowest Gas Prices !</button>
           <p>
            <input  type="text" name="geoposition1a" id="geoposition1a" size="10" >
            <input  type="text" name="geoposition1b" id="geoposition1b" size="10" >
            <input type="text" name="geoposition1c" id="geoposition1c" size="10" > 
            <input type="text" name="geoposition1d" id="geoposition1d" size="70">
           </p>
            
            
         </div>
      </div>
      
     <div class="row">
     <div> 
         <div id="showRecentExp" class="col-sm-6"></div>       
     </div>
    
    
     <div>         
        <div id="base" class="col-sm-6"></div>      
     </div>
     
  
     
     
     <div class="row">
        <div class="col-sm-12">
        <footer>
        Email: Brad Parker parkerb@@onid.oregonstate.edu  Copyright &#64 2015 BP Designs
        <script type="text/javascript" src="pajax.js"></script>        
        <script src ="http://api.mygeoposition.com/api/geopicker/api.js" type="text/javascript"></script>
        
       
        </footer>
        </div>
     </div>
        
    
        
        
             
</div> 
     
   
    
    
        
     
    
    
    
   
</div>
</body>
</html>

<?php


$un=$_SESSION['user'];

$ga="";
$ppg="";
    
if(isset($_POST["push"]))
{
    if(!is_numeric($_POST["mileage"]) || !is_numeric($_POST["cost"]) )
    {echo "<p style='color:red'>You need a number in Mileage or Cost field</p>";}
    else
    
    
    {
        echo $_POST["push"];
       
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
           
    
    

            $servername = "oniddb.cws.oregonstate.edu";
            $username = "parkerb2-db";
            $password = "RznqNou9jGnYkUSh";
            $dbname = "parkerb2-db";
    
            $conn = new mysqli($servername, $username, $password, $dbname);
            $stmt = $conn->prepare("INSERT INTO expenses (date,id,category,cost,description,mileage,gallons,ppg) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssdsiid",$da,$un,$tc,$co,$dc,$mg,$ga,$ppg);
            $stmt->execute();
            $conn->close();
         
        
            
            
    }
}
if(isset($_POST["deleteRecord"]))
{
    
            $servername = "oniddb.cws.oregonstate.edu";
            $username = "parkerb2-db";
            $password = "RznqNou9jGnYkUSh";
            $dbname = "parkerb2-db";
    
            $conn9 = new mysqli($servername, $username, $password, $dbname);      
                       
            $stmt9 = $conn9->prepare("DELETE FROM expenses WHERE id=? AND number=?");
            $stmt9->bind_param("si",$_POST["id"],$_POST["number"]);
            $stmt9->execute();
            //$sqln = "DELETE * FROM expenses WHERE id = ". $_POST['id'] . " AND number = " . $_POST['number']  ; 
           
            $conn9->close();
    
    
 }
            
          
            

?>









