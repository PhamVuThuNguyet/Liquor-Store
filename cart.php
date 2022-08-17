<!DOCTYPE html>
<html lang="en">
  	<head>
		<title>My Cart</title>
	<?php 
		include('linkrel.php');
	?>
  </head>
  <body>
  	<?php 
		include('nav.php');
	?>
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
			<div class="col-md-9 ftco-animate mb-5 text-center">
				<p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Cart <i class="fa fa-chevron-right"></i></span></p>
				<h2 class="mb-0 bread">My Cart</h2>
			</div>
			</div>
		</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="table-wrap">
					<table class="table">
						<thead class="thead-primary">
						    <tr>
						    	<th>&nbsp;</th>
						    	<th>&nbsp;</th>
						    	<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>&nbsp;</th>
						    </tr>
						</thead>						  
						<tbody>
							<?php 
								$ok=1;
								if(isset($_SESSION['cart'])){
									foreach($_SESSION['cart'] as $k => $v)
									{
										if(isset($k))
										{
											$ok=2;
										}
									}
								}
								if($ok == 2){
							?>
						  	<form action='updatecart.php' method='POST'>
						  	<?php
								foreach($_SESSION['cart'] as $key=>$value){
									$item[]=$key;
								}
								$str=implode(",",$item);
								$total=0;
								$connect=mysqli_connect("localhost","root","", "liquorstore") or die("Can not connect database");
								$sql="SELECT * FROM PRODUCTS WHERE id in ($str)";
								$query = mysqli_query($connect, $sql); 
								while($row = mysqli_fetch_array($query)){
							?>
						    <tr class="alert" role="alert">
						    	<td>
						    		<label class="checkbox-wrap checkbox-primary">
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
						    	</td>
						    	<td>
						    		<div class="img" style="background-image: url(<?php echo $row['img']?>);"></div>
						    	</td>
						      	<td>
									<div class="email">
										<span><?php echo $row['productname']?></span>
										<span><?php echo substr( $row['description'] , 0, 40 ).'...'?></span>
									</div>
						      	</td>
						      	<td><?php echo '$'.number_format($row['price'],2)?></td>
						      	<td class="quantity">
					        		<div class="input-group">
										<?php 
										echo "<input type='text' class='quantity form-control input-number' 
											name='qty[$row[id]]' size='5' value='{$_SESSION['cart'][$row['id']]}'>"; 
										?>
									
				          			</div>
				          		</td>
				          		<td><?php echo '$'.	number_format($_SESSION['cart'][$row['id']]*$row['price'],2)?></td>
								<td>
									<a href="deletecart.php?id=<?php echo $row['id'] ?>">
									<button type="button" class="close" >
										<span aria-hidden="true"><i class="fa fa-close"></i></span>
									</button>
									</a>
								</td>
							</tr>
							<?php $total+=$_SESSION['cart'][$row['id']]*$row['price'];?>
							<?php }}?>
						</tbody>						
					</table>
				</div>
			</div><br><br>
			<?php if($ok == 2){?>
			<input type='submit' name='submit' value='UpdateCart' class="btn btn-primary py-3 px-5"/>
			<a href="product.php?idcate=" class="btn btn-primary py-3 px-5">Shopping</a>
			</form>
    		<div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
						<h3>Cart Totals</h3>
							<p class="d-flex total-price">
								<span><?php echo '$'.number_format($total,2)?></span>
								<?php 
									$_SESSION['total'] = $total;
								?>
								<p class="text-center"><a href="checkout.php" class="btn btn-primary py-3 px-4" >Proceed to Checkout</a></p>
    						</p>
    				</div>
    			</div>
			</div>
			<?php 
				}else{							
					echo "<p align='center'>Your cart is empty<br /><a
						href='product.php?idcate='>Buy Products</a></p>";
				}
			?>
    	</div>
    </section>
	<?php 
      include('footer.php');
    ?>
  </body>
</html>