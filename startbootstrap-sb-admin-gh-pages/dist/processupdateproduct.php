<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $conn = mysqli_connect("localhost","root","","liquorstore");
            $productname = $_POST['productname'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $idcate = $_POST['idcate'];
            $description = $_POST['editor1'];
        if(($_FILES['upload']["name"]==null)){
            $sql = "UPDATE products SET idcate=$idcate, productname='$productname', quantity=$quantity, price=$price, description='$description' WHERE id=".$_GET['id'];
            $result = mysqli_query($conn, $sql);
        }else{
                //lấy tên của file:
                    $file_name=$_FILES['upload']["name"];
                    //lấy đường dẫn tạm lưu nội dung file:
                    $file_tmp =$_FILES['upload']['tmp_name'];
                    //tạo đường dẫn lưu file trên host:
                    $path ="images/".$file_name;
                    //upload nội dung file từ đường dẫn tạm vào đường dẫn vừa tạo:
                    move_uploaded_file($file_tmp,$path);
                    $sql = "UPDATE products SET idcate=$idcate, productname='$productname', quantity=$quantity, price=$price, description='$description', img='$path' WHERE id=".$_GET['id'];
                    $result = mysqli_query($conn, $sql);
        }
        header('Location: manageproduct.php');
    }
?>