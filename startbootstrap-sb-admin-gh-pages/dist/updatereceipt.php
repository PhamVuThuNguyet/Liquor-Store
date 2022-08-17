<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","liquorstore");
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM receipt WHERE id=".$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa trạng thái đơn hàng</title>
    <link rel="stylesheet" href="../../Admin/style.css" />
    <?php include('linkrel.php')?>
</head>
<body>
    <?php include('nav.php') ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Update Receipt Status</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Receipt Status</li>
                    </ol>
                    <?php
                        if(!isset($_SESSION['role'])){
                    ?>
                    <h1>Bạn không có quyền sửa trạng thái đơn hàng. Vui lòng quay lại</h1>
                    <?php }else{ if($_SESSION['role']==="admin"){ ?>
                    <form action="processupdatereceipt.php?id=<?php echo $_GET['id']?>" method="POST" style="margin-left: 10px">
                        Tên danh mục: <input type="text" name="status" value="<?php echo $row1['status']?>">
                        <input type = "submit" value="UPDATE"><br><br>
                        <?php }else{ ?>
                    <h1>Bạn không có quyền sửa  trạng thái đơn hàng. Vui lòng quay lại</h1>
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