<?php
session_start();
$un=$_SESSION['user'];

            $servername = "localhost";
            $username = "brad";
            $password = "brad";
            $dbname = "tracker";
    
            $conn = new mysqli($servername, $username, $password, $dbname);

            $records = $conn->query("SELECT * FROM expenses WHERE id='$un'");
            
            echo "<table border='1' cellpadding='3' cellspacing='0' width='600'>";
            echo "<tr>
            <td>Date</td> <td>Category</td> <td>Desription</td> <td align='right'>Cost</td> <td align='right'>Mileage</td> <td align='right'>Price/Gallon</td> <td>Modify</td>
            </tr>";
            while($row = $records->fetch_assoc())    
                {
                    $fcost=number_format($row['cost'],2);
                    $fppg = number_format($row['ppg'],2);
                    $fmileage = number_format($row['mileage'],0,'.',',');
                    echo "<tr>";
                    echo "<td>{$row['date']}</td> <td>{$row['category']}</td> <td>{$row['description']}</td> <td align='right'>\${$fcost}</td>
                    <td align='right'>$fmileage</td> <td align='right'>\$$fppg</td>";
                    
                    echo "<td>";
                    echo '<input type="button" value = "Delete" name="deleteRecord" onclick="deleteRecord()">';
                    echo '</td>';
                    
                    echo "</tr>";
                }

            echo "</table>";









?>