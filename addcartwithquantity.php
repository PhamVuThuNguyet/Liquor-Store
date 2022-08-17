<?php
    session_start();
    $id=$_GET['item'];
    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "liquorstore");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }			
    $sql = "SELECT * FROM products WHERE id = ".$_GET['idproduct'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(isset($_POST['submit']) or isset($_POST['submitbuy'])){
        if(($_POST['quantity'] > 0) and (is_numeric($_POST['quantity']))){   
            if($_POST['quantity'] > $row['quantity']){
                echo 'Không đủ số lượng hàng hóa';
            }
                if(isset($_SESSION['cart'][$id])){
                    $quantity = $_SESSION['cart'][$id] + $_POST['quantity'];
                }else{
                    $quantity= $_POST['quantity'];
                }
                $_SESSION['cart'][$id]=$quantity;
        }   
    }
    if(isset($_POST['submitbuy'])){
        header('Location: cart.php');
    }
    if(isset($_POST['submit'])){
        header('Location: product-single.php?idproduct='.$id);
    }
    exit();
?>