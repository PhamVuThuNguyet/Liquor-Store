<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Tracking</title>
    <?php include('./startbootstrap-sb-admin-gh-pages/dist/linkrel.php')?>
    <link href="./startbootstrap-sb-admin-gh-pages/dist/css/styles.css" rel="stylesheet" />
</head>
    <body>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Receipt Tracking</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Receipt Tracking
                            </div>
                            <?php
                                if(!isset($_SESSION['role'])){
                                ?>
                                <h1>Bạn không có quyền xem danh sách đơn hàng. Vui lòng quay lại</h1>
                                <?php
                                }else{                               
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
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
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
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "liquorstore");
                                                $sql = "SELECT * FROM receipt WHERE iduser =".$_SESSION['iduser'];
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
                                                    echo '<td>'.$row['total'].'</td>';
                                                    echo '<td>'.$row['status'].'</td>';
                                                    echo '</tr>';
                                                }
                                            ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
                            <br>
                            <a href="./" class="btn btn-primary py-3 px-4" >Home</a>
                        </div>
                    </div>

                </main>
            </div>
        </div>
        <?php include('./startbootstrap-sb-admin-gh-pages/dist/script.php')?>
        <script>
            $(document).ready( function () {
                $('#dataTable').DataTable();
            } );
        </script>
    </body>
</html>