<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $conn = mysqli_connect("localhost","root","","liquorstore");
            $st = $_POST['status'];
            $sql = "UPDATE receipt SET status = '$st' WHERE id=".$_GET['id'];
            $result = mysqli_query($conn, $sql);
            header('Location: salelist.php');
    }
?>