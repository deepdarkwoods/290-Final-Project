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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
    
<header>

    Vehicle Expense Tracker
   
</header>
<nav>  User:
     <form method="post" action="logout.php">
        <p class="submit"><input type="submit" name="out" value="Logout"></p>
    </form> 
<?php
 echo "hello $_SESSION[user]";
 ?>
 
 
</nav>

<section>

  
</section>
    
 
 
 
 



<footer>
  Email: Brad Parker parkerb@@onid.oregonstate.edu  Copyright &#64 2015 BP Designs
<script type="text/javascript" src="pajax.js"></script>
</footer>

</body>
</html> 