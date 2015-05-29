<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html');
            session_start();
            $un=$_SESSION['user'];

            $servername = "oniddb.cws.oregonstate.edu";
            $username = "parkerb2-db";
            $password = "RznqNou9jGnYkUSh";
            $dbname = "parkerb2-db";
    
            $conn = new mysqli($servername, $username, $password, $dbname);

            $records = $conn->query("SELECT * FROM expenses WHERE id='$un'");
            
            
            echo "<table class='expensetable' border='1'>";
            echo "<tr>";
            echo "<td>Date</td> <td>Category</td> <td>Desription</td> <td align='right'>Cost</td> <td align='right'>Mileage</td> <td align='right'>Price/Gallon</td> <td>Modify</td>";
            echo "</tr>";
            while($row = $records->fetch_assoc())    
                {  
                    $fcost=number_format($row['cost'],2);
                    $fppg = number_format($row['ppg'],2);
                    $fmileage = number_format($row['mileage'],0,'.',',');
                    $tid = $row["id"];
                    $tnumber = $row["number"];
                            
                
                    echo "<tr>";
                    echo "<td>{$row['date']}</td> <td>{$row['category']}</td> <td>{$row['description']}</td> <td align='right'>\${$fcost}</td><td align='right'>$fmileage</td> <td align='right'>\$$fppg</td>";
                    
                    
                    echo "<td>";
                    echo "<form class='expensetable' method='post' action='homepage.php'>";
                    echo "<input type = 'hidden' name='id' value='$tid'>";
                    echo "<input type = 'hidden' name='number' value='$tnumber'>";
                    echo "<input type='submit' value='Delete' name='deleteRecord'>";
                    echo "</td>";
                    
                    echo "</tr>";
                    
                   
                    
                    
                }

            echo "</table>";




?>