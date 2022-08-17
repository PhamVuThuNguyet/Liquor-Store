<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <?php include('linkrel.php')?>

</head>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Manage Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Categories</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Manage Categories
                            </div>
                            <?php
                                if(!isset($_SESSION['role'])){
                                ?>
                                <h1>Bạn không có quyền xem danh sách mặt hàng. Vui lòng quay lại</h1>
                                <?php
                                }else{
                                if($_SESSION['role']==="admin"){
                            ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Manage</th>                                             
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Manage</th>    
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "liquorstore");
                                                $sql = "SELECT * FROM categories";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo '<tr>';
                                                    echo '<td>'.$row['id'].'</td>';
                                                    echo '<td>'.$row['cate'].'</td>';
                                                    echo '<td>'.'<a href="deletecate.php?id='.$row['id'].'">'."Delete".'</a>';
												    echo " | ";
												    echo '<a href="updatecate.php?id='.$row['id'].'">'."Update".'</a>'.'</td>';
                                                    echo '</tr>';
                                                }
                                            ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền xem danh sách mặt hàng. Vui lòng quay lại</h1>
                            <?php }} ?>
                        </div>
                    </div>
                </main>
                <?php include('footer.php') ?>
            </div>
        </div>
        <?php include('script.php')?>
    </body>
</html>