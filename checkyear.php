<?php
$x = $_GET["inputyear"];

    if(!is_numeric($x) || (strlen($x) !=4))
    echo "<p style='color:red' >Please Enter a Valid Year </p>";
?>



