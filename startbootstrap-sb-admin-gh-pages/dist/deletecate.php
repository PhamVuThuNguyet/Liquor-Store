
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="../../Admin/style.css" />
    <?php include('linkrel.php')?>
</head>
<body>
    <?php 
        session_start();
        if(!isset($_SESSION['role'])){
    ?>
    <h1>Bạn không có quyền xóa danh mục hàng hóa. Vui lòng quay lại</h1>
    <?php
        }else{
        if($_SESSION['role']==="admin"){

        $conn = mysqli_connect("localhost", "root", "", "liquorstore");

        $sql = "DELETE FROM categories WHERE id =".$_GET['id'];

        $result = mysqli_query($conn, $sql);
    ?>
    <?php header('Location: managecate.php') ?>
    <?php }else{ ?>
        <h1>Bạn không có quyền xóa danh mục hàng hóa. Vui lòng quay lại</h1>
        
    <?php }} ?>
</body>
</html>