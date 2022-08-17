<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <?php include('linkrel.php')?>

</head>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Users List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users List</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Users List
                            </div>
                            <?php
                                if(!isset($_SESSION['role'])){
                                ?>
                                <h1>Bạn không có quyền xem danh sách người dùng. Vui lòng quay lại</h1>
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
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "liquorstore");
                                                $sql = "SELECT * FROM users where role = 'customer'";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo '<tr>';
                                                    echo '<td>'.$row['id'].'</td>';
                                                    echo '<td>'.$row['username'].'</td>';
                                                    echo '</tr>';
                                                }
                                            ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền xem danh sách người dùng. Vui lòng quay lại</h1>
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