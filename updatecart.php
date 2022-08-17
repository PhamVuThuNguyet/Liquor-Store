<?php
session_start();
    if(isset($_POST['submit']))
    {
    	foreach($_POST['qty'] as $key=>$value)
        {
            if( ($value == 0) and (is_numeric($value)))
            {
                unset ($_SESSION['cart'][$key]);
            }
            else if(($value > 0) and (is_numeric($value)))
            {
                $_SESSION['cart'][$key]=$value;
            }
        }
        header("location: cart.php");
    }
?>