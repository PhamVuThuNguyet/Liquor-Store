<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "liquorstore");
    $comment = $_POST['content'];
    $idproduct = $_POST['idproduct'];
    $id_user=$_SESSION['iduser'];
    $sql = "INSERT INTO comments (idproduct, iduser, content) VALUES ($idproduct, $id_user, '$comment')";
    $result = mysqli_query($connect, $sql);
    echo $_SESSION['user'];
?>