<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "liquorstore");
    $comment = $_POST['reply_text'];
    $id_user=$_SESSION['iduser'];
    $idcomment = $_GET['id'];
    $sql = "INSERT INTO replycomments (iduser, commentid, content) VALUES ($id_user, $idcomment, '$comment')";
    $result = mysqli_query($connect, $sql);
    header('Location: commentlist.php')
?>