<?php
            $conn = mysqli_connect("localhost", "root", "", "liquorstore");
            $sql = "SELECT MONTH(date) as MONTH, SUM(total) as SUM FROM RECEIPT GROUP BY MONTH";
            $query = mysqli_query($conn, $sql); 
            $item=array(0,0,0,0,0,0,0,0,0,0,0,0);
            while($row = mysqli_fetch_array($query)){
                $item[$row['MONTH']-1] = $row['SUM'];
            }
            $sql2 = "SELECT MONTH(date) as MONTH, COUNT(id) as COUNT FROM RECEIPT GROUP BY MONTH";
            $query2 = mysqli_query($conn, $sql2);
            $item2=array(0,0,0,0,0,0,0,0,0,0,0,0);
            while($row = mysqli_fetch_array($query2)){
                $item2[$row['MONTH']-1] = $row['COUNT'];
                echo $item2[$row['MONTH']-1];
            }
        ?>