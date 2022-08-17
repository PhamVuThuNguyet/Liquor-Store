<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if($_GET['price']=='<$100'){
            if(isset($_SESSION['minprice'])){
                unset($_SESSION['minprice']);
            }
            $_SESSION['maxprice'] = 100;
            $_SESSION['price'] = $_GET['price'];
        }
        else if($_GET['price']=='$100-$500'){
            $_SESSION['minprice'] = 100;
            $_SESSION['maxprice'] = 500;
            $_SESSION['price'] = $_GET['price'];
        }
        else if($_GET['price']=='>$500'){
            if(isset($_SESSION['maxprice'])){
                unset($_SESSION['maxprice']);
            }
            $_SESSION['minprice'] = 500;
            $_SESSION['price'] = $_GET['price'];
        }
        else{
            if(isset($_SESSION['maxprice'])){
                unset($_SESSION['maxprice']);
            }
            if(isset($_SESSION['minprice'])){
                unset($_SESSION['minprice']);
            }
            if(isset($_SESSION['price'])){
                unset($_SESSION['price']);
            }
        }

        header('Location: product.php?idcate=');
    }