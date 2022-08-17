<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $conn = mysqli_connect("localhost","root","","liquorstore");
            $cate = $_POST['cate'];
            $sql = "UPDATE categories SET cate = '$cate' WHERE id=".$_GET['id'];
            $result = mysqli_query($conn, $sql);
            header('Location: managecate.php');
    }
?>