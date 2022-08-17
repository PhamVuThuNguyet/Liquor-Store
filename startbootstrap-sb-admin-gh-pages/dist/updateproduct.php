<?php
    session_start();
    $img_error='';
    $conn = mysqli_connect("localhost","root","","liquorstore");
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM products WHERE id=".$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);       
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa hàng hóa</title>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="../../Admin/style.css" />
    <?php include('linkrel.php')?>
</head>
<body>
    <?php include('nav.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Update Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Update Products</li>
                        </ol>
                    <?php
                        if(!isset($_SESSION['role'])){
                    ?>
                    <h1>Bạn không có quyền sửa hàng hóa. Vui lòng quay lại</h1>
                    <?php }else{ if($_SESSION['role']==="admin"){ ?>
                        <form action="processupdateproduct.php?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data" style="margin-left: 10px;">
                            <div class="flex_row"><label>Product name: </label><input type="text" name="productname" value="<?php echo $row1['productname']; ?>"></div>
                            <div class="flex_row"><label>Quantity: </label><input type="text" name="quantity" value="<?php echo $row1['quantity']; ?>"></div>
                            <div class="flex_row"><label>Price: </label><input type="text" name="price" value="<?php echo $row1['price']; ?>"></div>
                            <div class="flex_row">
                                <label>Category: </label>
                                <select name="idcate" style="width: 84%;">
                                    <?php
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                        $selected = '';
                                    ?>                  
                                            <option value="<?php echo $row['id']?>" 
                                            <?php 
                                                if($row['id']==$row1['idcate']){
                                            ?>
                                            selected = "selected";    
                                            <?php }?>
                                            ><?php echo $row['cate']; ?></option>
                                    <?php    
                                        }
                                    ?>
                                </select>
                            </div>
                            Description: <br><br>
                            <textarea name="editor1" id="editor1" rows="10" cols="80" value><?php echo $row1['description'] ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script><br><br>
                            <input class="form-control" type="file" name="upload"><br><br>
                            <?php echo $img_error?>
                            <input type="submit" value="Update"> <br><br>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền sửa hàng hóa. Vui lòng quay lại</h1>
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