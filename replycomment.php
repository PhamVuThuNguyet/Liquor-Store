<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "liquorstore");
    $comment = $_POST['content'];
    $id_user=$_SESSION['iduser'];
    $idcomment = $_POST['idcomment'];
    $sql = "INSERT INTO replycomments (iduser, commentid, content) VALUES ($id_user, $idcomment, '$comment')";
    $result = mysqli_query($connect, $sql);
    echo $_SESSION['user'];
?>