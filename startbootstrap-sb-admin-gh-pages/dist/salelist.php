<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sales</title>
    <?php include('linkrel.php')?>

</head>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Sales List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales List</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Sales List
                            </div>
                            <?php
                                if(!isset($_SESSION['role'])){
                                ?>
                                <h1>Bạn không có quyền xem danh sách đơn hàng. Vui lòng quay lại</h1>
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
                                                <th>ID User</th>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Change status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID User</th>
                                                <th>Customer Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Change status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "liquorstore");
                                                $sql = "SELECT * FROM receipt";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo '<tr>';
                                                    echo '<td>'.$row['id'].'</td>';
                                                    echo '<td>'.$row['iduser'].'</td>';
                                                    echo '<td>'.$row['customername'].'</td>';
                                                    echo '<td>'.$row['address'].'</td>';
                                                    echo '<td>'.$row['phone'].'</td>';
                                                    echo '<td>'.$row['email'].'</td>';
                                                    echo '<td>'.$row['date'].'</td>';
                                                    echo '<td>'.$row['updated_at'].'</td>';
                                                    echo '<td>'.$row['total'].'</td>';
                                                    echo '<td>'.$row['status'].'</td>';
                                                    echo '<td> <a href="updatereceipt.php?id='.$row['id'].'">'."Update".'</a>'.'</td>';
                                                    echo '</tr>';
                                                }
                                            ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền xem danh sách đơn hàng. Vui lòng quay lại</h1>
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