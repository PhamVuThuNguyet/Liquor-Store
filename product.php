<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shopping - Products</title>
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
						<p class="breadcrumbs mb-0">
							<span class="mr-2">
								<a href="index.php">Home 
									<i class="fa fa-chevron-right"></i>
								</a>
							</span>
							<span>Products
								<i class="fa fa-chevron-right"></i>
							</span>
						</p>
						<h2 class="mb-0 bread">Products</h2>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="row mb-4">
							<div class="col-md-12 d-flex justify-content-between align-items-center">
								<form action = "product.php" method="GET">
								<input type="text" name="search" style="width: 33vw">
								<?php
									$servername = "localhost";
									$username = "root";
									$password = "";
									$dbname = "liquorstore";
									// Create connection
									$conn = mysqli_connect($servername, $username, $password, $dbname);
									// Check connection
									if (!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$sql = "SELECT * FROM categories";
									$result = $conn->query($sql);
								?>
								<select class="selectpicker" name="idcate">
									<?php 
										while($row = $result->fetch_assoc()){
											$ID = $row['id'];
											$name = $row['cate'];
									?>
											<option value="<?php echo $ID?>" 
												<?php if($ID==$_GET['idcate']){?>
													selected="selected";
												<?php }?>>
												<?php
													echo $row['cate'];
												?>
											</option>
									<?php 
										}
									?>
									<option value = "" <?php if($_GET['idcate']==null){?>
													selected="selected";
												<?php }?>>All Categories</option>
								</select>
								<input type="submit" value="SEARCH" style="cursor: pointer">	
								</form>
								
							</div>
								<form action = "price.php" method="GET" style="margin-left: 14px; margin-top: 15px">
									<span style="margin-right: 100px;">Find by price: </span>
									<select class="selectpicker" name="price">
										<option value="<$100"
											<?php if(isset($_SESSION['price'])&&$_SESSION['price']=='<$100'){?>
												selected="selected";
											<?php }?>>
												Lower than $100
										</option>
										<option value="$100-$500"
											<?php if(isset($_SESSION['price'])&&$_SESSION['price']=='$100-$500'){?>
												selected="selected";
											<?php }?>>
												$100-$500
										</option>
										<option value=">$500"
										<?php if(isset($_SESSION['price'])&&$_SESSION['price']=='>$500'){?>
												selected="selected";
											<?php }?>>Higher than $500</option>
										<option value="all"
										<?php if(!isset($_SESSION['price'])||$_SESSION['price']=='all'){?>
												selected="selected";
										<?php }?>>All of price range</option>								
									</select>
									<input type="submit" value="SEARCH" style="cursor: pointer">	
								</form>
							<div>
							<form action = "rsperpage.php" method="GET" style="margin-left: 14px; margin-top: 15px">
							<span style="margin-right: 20px;">Change Result Per Page: </span>
								<select class="selectpicker" name="rsperpage">
									<option value="3"
										<?php if(!isset($_SESSION['rsperpage'])||$_SESSION['rsperpage']==3){?>
											selected="selected";
										<?php }?>>
											3
									</option>
									<option value="5"
										<?php if(isset($_SESSION['rsperpage'])&&$_SESSION['rsperpage']==5){?>
											selected="selected";
										<?php }?>>
											5
									</option>
									<option value="10"
									<?php if(isset($_SESSION['rsperpage'])&&$_SESSION['rsperpage']==10){?>
											selected="selected";
										<?php }?>>10</option>
									<option value="15"
									<?php if(isset($_SESSION['rsperpage'])&&$_SESSION['rsperpage']==15){?>
											selected="selected";
										<?php }?>>15</option>
									<option value="20"
									<?php if(isset($_SESSION['rsperpage'])&&$_SESSION['rsperpage']==20){?>
											selected="selected";
										<?php }?>>20</option>
									<option value="25"
									<?php if(isset($_SESSION['rsperpage'])&&$_SESSION['rsperpage']==25){?>
											selected="selected";
										<?php }?>>25</option>
									
								</select>
								<input type="submit" value="CHANGE" style="cursor: pointer">	
								</form>
							</div>
						</div>
						<div class="row">
							<?php
							if(isset($_SESSION['rsperpage'])){
								$results_per_page = $_SESSION['rsperpage'];  
							}
							else{
								$_SESSION['rsperpage'] = 3;
								$results_per_page = $_SESSION['rsperpage'];  
							}
								$servername = "localhost";
								$username = "root";
								$password = "";
								$dbname = "liquorstore";
									
								// Create connection
								$conn = mysqli_connect($servername, $username, $password, $dbname);
								// Check connection
								if (!$conn) {
									die("Connection failed: " . mysqli_connect_error());
								}
								if(isset($_GET['search'])){
									$search = $_GET['search'];
									if($_GET['idcate']==null){
										if(isset($_SESSION['price'])){
											$sql = "SELECT * FROM products WHERE productname like '%".$search."%' AND price";
										}
										else{
											$sql = "SELECT * FROM products WHERE productname like '%".$search."%'";
										}
									}
									else{
										if(isset($_SESSION['price'])){
											$sql = "SELECT * FROM products WHERE idcate = ".$_GET['idcate']." AND productname like '%".$search."%' AND price";
										}
										else{
											$sql = "SELECT * FROM products WHERE idcate = ".$_GET['idcate']." AND productname like '%".$search."%'";
										}
									}
								}else{
										if($_GET['idcate']==null){
											if(isset($_SESSION['price'])){
												$sql = "SELECT * FROM products WHERE price";
											}
											else{
												$sql = "SELECT * FROM products";
											}
										}
										else{
											if(isset($_SESSION['price'])){
												$sql = "SELECT * FROM products WHERE idcate = ".$_GET['idcate']." AND price";
											}
											else{
												$sql = "SELECT * FROM products WHERE idcate = ".$_GET['idcate'];
											}
										}
								}
								if(isset($_SESSION['price'])){
									if(isset($_SESSION['minprice']) && isset($_SESSION['maxprice'])){
										$sql.= " BETWEEN ".$_SESSION['minprice']." AND ".$_SESSION['maxprice'];
									}
									else if(!isset($_SESSION['minprice']) && isset($_SESSION['maxprice']) ){
										$sql.= " < ".$_SESSION['maxprice'];
									}
									else if(isset($_SESSION['minprice']) && !isset($_SESSION['maxprice'])){
										$sql.= " > ".$_SESSION['minprice'];
									}
								}
									$result = $conn->query($sql);
									$number_of_result = mysqli_num_rows($result);
									//determine the total number of pages available  
									$number_of_page = ceil ($number_of_result / $results_per_page);
									//determine which page number visitor is currently on 
									if (!isset ($_GET['page']) ) {  
										$page = 1;  
									} else {  
										$page = $_GET['page'];  
									}
									//determine the sql LIMIT starting number for the results on the displaying page  
									$page_first_result = ($page-1) * $results_per_page;
									//retrieve the selected results from database   
									$sql = $sql." LIMIT ".$page_first_result.','.$results_per_page;  
									$result = mysqli_query($conn, $sql);  
									//display the retrieved result on the webpage    
									while($row = $result->fetch_assoc()){
										$id = $row['id'];
										$idcate = $row['idcate'];
										$name = $row['productname'];
										$price = $row['price'];
										$img = $row['img'];
										$sql2 = "SELECT * FROM categories WHERE id = $idcate";
										$result2 = $conn->query($sql2);
								?>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" 
										style="background-image: url(<?php echo $img?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
											<?php 
													if($row['quantity']>0){
												?>
													<a href="addcart.php?item=<?php echo $id?>" 
														class="d-flex align-items-center justify-content-center">
														<span class="flaticon-shopping-bag"></span>
													</a>
												<?php }else{ ?>
													<a
														class="d-flex align-items-center justify-content-center" >
														<span style="margin-left: 7px">SOLD OUT</span>													
													</a>
												<?php }?>
												<a href="#" class="d-flex align-items-center justify-content-center">
													<span class="flaticon-heart"></span>
												</a>
												<a href="product-single.php?idproduct=<?php echo $id?>" 
													class="d-flex align-items-center justify-content-center">
													<span class="flaticon-visibility"></span>
												</a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<?php 
											while($row2 = $result2->fetch_assoc()){
												$namecate = $row2['cate'];
										?>
										<span class="category"><?php echo $namecate?></span>
										<?php 
											}
										?>
										<h2><?php echo $row['productname']?></h2>
										<span class="price"><?php echo '$'.number_format($price,2)?></span>
										<?php 
											if(isset($_SESSION['user'])){
											if($_SESSION['role']==='admin'){
										?>
											<div>
												<a href="./startbootstrap-sb-admin-gh-pages/dist/deleteproduct.php?id=<?php echo $id ?>">Delete</a>
												|
												<a href="./startbootstrap-sb-admin-gh-pages/dist/updateproduct.php?id=<?php echo $id ?>">Update</a>
											</div>
										<?php
											}}
										?>
									</div>
								</div>
							</div>
								<?php 
									}
								?>
						</div>

						<div class="row mt-5">
							<div class="col text-center">
								<div class="block-27">
									<ul>
									<?php for($page = 1; $page<= $number_of_page; $page++) {?>  
										<li><a href="product.php?page=<?php echo $page?>&idcate=<?php echo $_GET['idcate']?>"><?php echo $page?></a></li>
									<?php }?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="sidebar-box ftco-animate">
							<div class="categories">
								<h3>Product Types</h3>
								<?php
									$servername = "localhost";
									$username = "root";
									$password = "";
									$dbname = "liquorstore";
									// Create connection
									$conn = mysqli_connect($servername, $username, $password, $dbname);
									// Check connection
									if (!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$sql = "SELECT * FROM categories";
									$result = $conn->query($sql);
								?>
								<ul class="p-0">
									<?php 
										while($row = $result->fetch_assoc()){
											$ID = $row['id'];
											$name = $row['cate'];
									?>
									<?php 
										if(isset($_SESSION['user'])){
										if($_SESSION['role']==='admin'){
									?>
										<span>
											<a href="./startbootstrap-sb-admin-gh-pages/dist/deletecate.php?id=<?php echo $ID ?>">Delete</a>
											|
											<a href="./startbootstrap-sb-admin-gh-pages/dist/updatecate.php?id=<?php echo $ID ?>">Update</a>
										</span>
									<?php
										}}
									?>
									<li>
										<?php
											echo '<a href = "product.php?idcate='.$row['id'].'">'.$row['cate'];
										?>
										<span class="fa fa-chevron-right"></span></a>
									</li>

									<?php
										}
									?>
								</ul>
							</div>
						</div>

						<div class="sidebar-box ftco-animate">
							<h3>Recent Blog</h3>
							<div class="block-21 mb-4 d-flex">
								<a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
								<div class="text">
									<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
									<div class="meta">
										<div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
										<div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
									</div>
								</div>
							</div>
							<div class="block-21 mb-4 d-flex">
								<a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
								<div class="text">
									<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
									<div class="meta">
										<div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
										<div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
									</div>
								</div>
							</div>
							<div class="block-21 mb-4 d-flex">
								<a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
								<div class="text">
									<h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
									<div class="meta">
										<div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
										<div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<?php 
			include('footer.php');
		?>
		

	  </body>
	  
</html>