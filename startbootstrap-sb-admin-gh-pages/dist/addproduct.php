<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "liquorstore");
    $img_error='';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if((!isset($_FILES['upload']))||$_FILES['upload']["name"]==null){
            $img_error='Please upload your file';
        }else{
            //lấy tên của file:
				$file_name=$_FILES['upload']["name"];
				//lấy đường dẫn tạm lưu nội dung file:
				$file_tmp =$_FILES['upload']['tmp_name'];
				//tạo đường dẫn lưu file trên host:
				$path ="images/".$file_name;
				//upload nội dung file từ đường dẫn tạm vào đường dẫn vừa tạo:
                move_uploaded_file($file_tmp,$path);
                $productname = $_POST['productname'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $idcate = $_POST['idcate'];
                $description = $_POST['editor1'];
                $sql = "INSERT INTO products(idcate, productname, quantity, price, description, img) VALUES($idcate, '$productname', $quantity, $price,'$description', '$path' )";

                $result = mysqli_query($conn, $sql);
        }       
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('linkrel.php') ?>
        <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
        <title>Add Products</title>
        <link rel="stylesheet" href="../../Admin/style.css" />
    </head>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Add Product</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        <?php
                            if(!isset($_SESSION['role'])){
                        ?>
                        <h1>Bạn không có quyền thêm hàng hóa. Vui lòng quay lại</h1>
                        <?php }else{ if($_SESSION['role']==="admin"){ ?>
                        <form action="addproduct.php" method="POST" enctype="multipart/form-data" style="margin-left: 20px">
                            <div class="flex_row"><label>Product name: </label><input type="text" name="productname"></div>
                            <div class="flex_row"><label>Quantity: </label><input type="text" name="quantity"></div>
                            <div class="flex_row"><label>Price: </label><input type="text" name="price"></div>
                            <div class="flex_row">
                                <label>Category: </label>
                                <select name="idcate" style="width: 84%;">
                                    <?php
                                        $sql = "SELECT * FROM categories";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                            <option value="<?php echo $row['id']?>"><?php echo $row['cate']; ?></option>
                                    <?php    
                                        }
                                    ?>
                                </select>
                            </div>
                            Description: <br><br>
                            <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor 4
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script><br><br>
                            <input class="form-control" type="file" name="upload"><br><br>
                            <?php echo $img_error?>
                            <input type="submit" value="ADD"> <br><br>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền thêm hàng hóa. Vui lòng quay lại</h1>
                            <?php }}?>
                        </form>
                    </div>
                </main>
            <?php include('footer.php') ?>
            </div>
        </div>
        <?php include('script.php')?>
    </body>
</html>