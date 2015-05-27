<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');

$x = $_GET["inputyear"];

    if(!is_numeric($x) || (strlen($x) !=4))
    echo "<p style='color:red' >Please Enter a Valid Year </p>";
?>



