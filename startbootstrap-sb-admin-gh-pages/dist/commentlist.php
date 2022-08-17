<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Comments</title>
    <?php include('linkrel.php')?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<script>
		$(document).ready(function(){
            $(document).on('click', '.reply-btn', function(e){
                e.preventDefault();
                // Get the comment id from the reply button's data-id attribute
                var comment_id = $(this).data('id');
                // show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
                // and then its siblings which is a form element with id comment_reply_form_ + comment_id)
                $('#reply_'+comment_id).toggle();
            });
    });
</script>
    <body>
        <?php include('nav.php') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Manage Comments</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Comments</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Manage Comments
                            </div>
                            <?php
                                if(!isset($_SESSION['role'])){
                                ?>
                                <h1>Bạn không có quyền xem danh sách bình luận. Vui lòng quay lại</h1>
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
                                                <th>ID Product</th>
                                                <th>ID User</th>
                                                <th>Content</th>
                                                <th>Date</th>
                                                <th>Reply</th>                                             
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID Product</th>
                                                <th>ID User</th>
                                                <th>Content</th>
                                                <th>Date</th>
                                                <th>Reply</th>     
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $conn = mysqli_connect("localhost", "root", "", "liquorstore");
                                                $sql = "SELECT * FROM comments";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_assoc($result)){
                                                    echo '<tr>';
                                                    echo '<td>'.$row['id'].'</td>';
                                                    echo '<td>'.$row['idproduct'].'</td>';
                                                    echo '<td>'.$row['iduser'].'</td>';
                                                    echo '<td>'.$row['content'].'</td>';
                                                    echo '<td>'.$row['date'].'</td>';
                                                    echo '<td>';
                                            ?>
                                            <a class="reply-btn" href="#" data-id="<?php echo $row['id']; ?>">Reply</a>
                                            <?php
                                                   
												    echo " | ";
                                                    echo '<a href="deletecomment.php?id='.$row['id'].'">'."Delete".'</a>';
                                            ?>
                                            <form style="display:none" id="reply_<?php echo $row['id'] ?>" action="replycomment.php?id=<?php echo $row['id']?>" method="POST">
											<input type="text" name="reply_text" style="width: 60%">
											<input type="submit" value="Reply">
											</form>
                                            <?php
                                                    echo '</td> </tr>';
                                                }
                                            ?>                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <h1>Bạn không có quyền xem danh sách bình luận. Vui lòng quay lại</h1>
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