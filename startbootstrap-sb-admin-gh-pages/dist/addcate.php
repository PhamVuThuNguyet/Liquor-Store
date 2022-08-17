<?php
    session_start();
    if(isset($_GET['cate'])){
        $conn = mysqli_connect("localhost", "root", "", "liquorstore");
        $sql = "INSERT INTO categories(cate) VALUES('".$_GET['cate']."')";
        $result = mysqli_query($conn, $sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('linkrel.php') ?>
        <title>Add Category</title>
        <link rel="stylesheet" href="../../Admin/style.css" />
    </head>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Add Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                        <?php 
                            if(!isset($_SESSION['role'])){
                        ?>
                        <h1>Bạn không có quyền thêm danh mục hàng hóa. Vui lòng quay lại</h1>
                        <?php
                            }else{if($_SESSION['role']==="admin"){
                        ?>
                        <br><br>
                        <form action="addcate.php" method="GET" style="margin-left: 10px">
                            Tên danh mục: <input type="text" name="cate">
                            <input type = "submit" value="ADD"><br><br>
                            <?php }else{ ?>
                        <h1>Bạn không có quyền thêm danh mục hàng hóa. Vui lòng quay lại</h1>
                        <?php }} ?>
                        </form>
                    </div>
                </main>
            <?php include('footer.php') ?>
            </div>
        </div>
        <?php include('script.php')?>
    </body>
</html>