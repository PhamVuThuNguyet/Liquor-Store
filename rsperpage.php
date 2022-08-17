<?php
session_start();
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $_SESSION['rsperpage'] = $_GET['rsperpage'];
        header('Location: product.php?idcate=');
    }