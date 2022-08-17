<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Comment</title>
    <?php include('linkrel.php')?>
</head>
<body>
    <?php 
        if(!isset($_SESSION['role'])){
    ?>
    <h1>Bạn không có quyền xóa hàng hóa. Vui lòng quay lại</h1>
    <?php
        }else{
            if($_SESSION['role']==="admin"){

                $conn = mysqli_connect("localhost", "root", "", "liquorstore");

                $sql = "DELETE FROM comments WHERE id =".$_GET['id'];

                $result = mysqli_query($conn, $sql);
    ?>
    <?php header('Location: commentlist.php') ?>
    <?php }else{ ?>
        <h1>Bạn không có quyền xóa hàng hóa. Vui lòng quay lại</h1>
    <?php }} ?>
</body>
</html>