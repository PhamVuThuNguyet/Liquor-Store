<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Products - Shopping Now</title>
		<?php 
			include('linkrel.php');
		?>
	</head>
  	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script>//AJAX
		$(document).ready(function(){
        $('#sendcomment').click(function(){
            var url_string = window.location.href;
            var url = new URL(url_string);
            var idsp = url.searchParams.get("idproduct");
            var txt = $("#comment").val();
			var d = new Date(Date.now());
			const formattedDate = d.getFullYear()+'-'+("0"+(d.getMonth()+1)).slice(-2)+'-'+("0"+d.getDate()).slice(-2) + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds(); 
            var avatar = "";
			$.get("getava.php", function(ava){
				avatar = ava;
			})
			$.post("comment.php", {content: txt, idproduct: idsp}, function(result){
                $("#commentlist").append(
					'<div class="review">' +
						'<div class="user-img" style="background-image: url('+avatar+')">' + '</div>' +
						'<div class="desc">' +
				   			'<h4>' +
								'<span class="text-left">' + result +'</span>' +
				   				'<span class="text-right">' + formattedDate + '</span>' +
				 			'</h4>' +
							'<p>' + txt +
							'</p>' +
						'</div>' +
					'</div>'
				);
				$("#comment").val('');
            });
		});
		
		$(document).on('click', '.reply-btn', function(e){
			e.preventDefault();
			// Get the comment id from the reply button's data-id attribute
			var comment_id = $(this).data('id');
			// show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
			// and then its siblings which is a form element with id comment_reply_form_ + comment_id)
			$('#reply_'+comment_id).toggle();
			$('#sendreply_'+comment_id).click(function(){
				e.preventDefault();
				// elements
				var reply_text = $("#reply_text_"+comment_id).val();
				var d = new Date(Date.now());
				const formattedDate = d.getFullYear()+'-'+("0"+(d.getMonth()+1)).slice(-2)+'-'+("0"+d.getDate()).slice(-2) + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds(); 
				var avatar = "";
				$.get("getava.php", function(ava){
					avatar = ava;
				})
				$.post("replycomment.php", {content: reply_text, idcomment: comment_id}, function(result){
					$("#replylist_"+comment_id).append(
						'<div class="review" style="margin-left: 80px; width: 87%">'+
							'<div class="user-img" style="background-image: url('+avatar+')">'+'</div>'+
							'<div class="desc">'+
								'<h4>'+
									'<span class="text-left">'+result+'</span>'+
									'<span class="text-right">'+formattedDate+'</span>'+
								'</h4>'+
								'<p>'+reply_text+
								'</p>'+
							'</div>'+
						'</div>'
					);
					$("#reply_text_"+comment_id).val('');
				});
			});
		});
    });
	</script>
  <body>

  	<?php 
		include('nav.php');
	?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate mb-5 text-center">
					<p class="breadcrumbs mb-0">
						<span class="mr-2">
							<a href="index.php">Home 
								<i class="fa fa-chevron-right"></i>
							</a>
						</span>
						<span>
							<a href="product.php">Products
								<i class="fa fa-chevron-right"></i>
							</a>
						</span>
						<span>Products Single
							<i class="fa fa-chevron-right"></i>
						</span>
					</p>
					<h2 class="mb-0 bread">Products Single</h2>
				</div>
			</div>
      	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
			<?php
				// Create connection
				$conn = mysqli_connect("localhost", "root", "", "liquorstore");
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}			
				$sql = "SELECT * FROM products WHERE id = ".$_GET['idproduct'];
				$result = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($result)){
				$id = $row['id'];
				$name = $row['productname'];
				$quantity = $row['quantity'];
				$price = $row['price'];
				$description = $row['description'];
				$img = $row['img'];
			?>
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
					<a href="<?php echo $img?>" class="image-popup prod-img-bg">
						<img src="<?php echo $img?>" class="img-fluid" alt="IMG">
					</a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $name?></h3>
    				<div class="rating d-flex">
						<p class="text-left mr-4">
							<a href="#" class="mr-2">5.0</a>
							<a href="#"><span class="fa fa-star"></span></a>
							<a href="#"><span class="fa fa-star"></span></a>
							<a href="#"><span class="fa fa-star"></span></a>
							<a href="#"><span class="fa fa-star"></span></a>
							<a href="#"><span class="fa fa-star"></span></a>
						</p>
						<p class="text-left mr-4">
							<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
						</p>
						<p class="text-left">
							<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
						</p>
					</div>
					<p class="price"></p>
					<span><?php echo '$'.number_format($row['price'],2)?></span>
					<p><?php echo $description?></p>
					<form action="addcartwithquantity.php?item=<?php echo $id?>" method="POST">
					<div class="row mt-4">
						<div class="input-group col-md-6 d-flex mb-3">
							<?php if ($row['quantity'] > 0){ ?>
							<input type="number" id="quantity" name="quantity" class="quantity form-control input-number" 
								value="1" min="1" max="<?php echo $quantity?>">
							<?php }else{ ?>
								<input type="number" id="quantity" name="quantity" class="quantity form-control input-number" 
								value="0" min="0" max="0">
							<?php } ?>
	          			</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;"><?php echo $quantity?>	available</p>
						</div>
					  </div>
					  <?php if ($quantity> 0){ ?>
          			<p>
						<input class="btn btn-primary py-3 px-5 mr-2" type="submit" name="submit" value="Add to Cart"></input>
						<input class="btn btn-primary py-3 px-5" type="submit" name="submitbuy" value="Buy now"></input>
					</p>
					<?php }else{ ?>
						<input class="btn btn-primary py-3 px-5 mr-2" type="submit" name="submit" value="Add to Cart" disabled="disabled"></input>
						<input class="btn btn-primary py-3 px-5" type="submit" name="submitbuy" value="Buy now"  disabled="disabled"></input>
					<?php } ?>
					</form>
    			</div>
    		</div>

    		<div class="row mt-5">
          		<div class="col-md-12 nav-link-wrap">
					<div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" 
							role="tab" aria-controls="v-pills-1" aria-selected="true">Description
						</a>
						<a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" 
							aria-controls="v-pills-2" aria-selected="false">Manufacturer
						</a>
						<a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" 
							aria-controls="v-pills-3" aria-selected="false">Reviews
						</a>
					</div>
          		</div>
          		<div class="col-md-12 tab-wrap">
            		<div class="tab-content bg-light" id="v-pills-tabContent">
              			<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
							<div class="p-4">
								<h3 class="mb-4"><?php echo $name?></h3>
								<p><?php echo $description?></p>
							</div>
              			</div>
						<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
							<div class="p-4">
								<h3 class="mb-4">Manufactured By Liquor Store</h3>
								<p><?php echo $description?></p>
							</div>
						</div>
              			<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
              				<div class="row p-4">
						   		<div class="col-md-7">
									   <?php
									   	$connect = mysqli_connect("localhost", "root", "", "liquorstore");
										$sql = "SELECT * FROM comments WHERE idproduct = $id";
										$result = mysqli_query($connect, $sql);
										$qtycmt = mysqli_num_rows($result);
										?>
										<h3 class="mb-4"><?php echo $qtycmt?> Comments</h3>
										<?php
										while($comment = mysqli_fetch_assoc($result)){
											$sql2 = "SELECT * FROM users WHERE id=".$comment['iduser'];
											$result2 = mysqli_query($connect, $sql2);
											$user = mysqli_fetch_assoc($result2);
											$sql3 = "SELECT * FROM replycomments WHERE commentid=".$comment['id'];
											$result3 = mysqli_query($connect, $sql3);
											
										?>
						   			<div class="review">
								   		<div class="user-img" style="background-image: url(<?php echo $user['avatar']?>)"></div>
								   		<div class="desc">
								   			<h4>
								   				<span class="text-left"><?php echo $user['username'] ?></span>
								   				<span class="text-right"><?php echo $comment['date'] ?></span>
								   			</h4>
								   			<p><?php echo $comment['content'] ?>
											</p>
											<a class="reply-btn" href="#" data-id="<?php echo $comment['id']; ?>">reply</a>
										   </div>
										   <div style="display:none" id="reply_<?php echo $comment['id'] ?>" data-id="<?php echo $comment['id']; ?>">
											<input type="text" name="reply_text" id="reply_text_<?php echo $comment['id'] ?>" style="width: 90%">
											<input type="submit" value="Reply" id="sendreply_<?php echo $comment['id'] ?>">
											</div>
									</div>
									<?php 
										while($replies = mysqli_fetch_assoc($result3)){
												$sql4 = "SELECT * FROM users WHERE id=".$replies['iduser'];
												$result4 = mysqli_query($connect, $sql4);
												$user2 = mysqli_fetch_assoc($result4);
									?>
									<div class="review" style="margin-left: 80px; width: 87%">
								   		<div class="user-img" style="background-image: url(<?php echo $user2['avatar']?>)"></div>
								   		<div class="desc">
								   			<h4>
								   				<span class="text-left"><?php echo $user2['username'] ?></span>
								   				<span class="text-right"><?php echo $replies['date'] ?></span>
								   			</h4>
								   			<p><?php echo $replies['content'] ?>
											</p>
								   		</div>
									</div>
										<?php }?>
									<div id="replylist_<?php echo $comment['id']; ?>"></div>
									<?php }?>
									<div id="commentlist">
        
   									</div>
						   		</div>
						   		<div class="col-md-4">
						   			<div class="rating-wrap">
									   <?php
									 		if(isset($_SESSION['user'])){  
									   ?>
										   <h3 class="mb-4">Give a Review</h3>
										   <input type="text" name="comment" id="comment">
    									   <input type="submit" value="Comment" id="sendcomment">
										<?php
											 }else{
										?>
												<h3 class="mb-4">Give a Review</h3>
												<h5>Please Login to give a review</h5>
										<?php
											 }
										?>
							   		</div>
						   		</div>
						   	</div>
              			</div>
            		</div>
          		</div>
			</div>
			<?php }?>
    	</div>
    </section>
    
	<?php 
      include('footer.php');
	?>
	
	<script>

	</script>

  </body>
</html>