<?php session_start()?>
  	<div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 phone pl-md-2">
						<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +84 941 257 069</a> 
						<a href="#"><span class="fa fa-paper-plane mr-1"></span> pvtnguyet.19it1@vku.udn.vn</a>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media mr-4">
						<p class="mb-0 d-flex">
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
						</p>
					</div>
					<div class="reg">
						<p class="mb-0">
							<?php 
								if(!isset($_SESSION['user'])){
							?>
							<a href="signup.php" class="mr-2">Sign Up</a> 
							<a href="login.php">Log In</a>
							<?php }?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="/liquorstore">Liquor <span>store</span></a>
	      <div class="order-lg-7 btn-group">
			<a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="flaticon-shopping-bag"></span>
				<div class="d-flex justify-content-center align-items-center"><small>
				<?php 
				$ok=1;
                if(isset($_SESSION['cart']))
                {
                    foreach($_SESSION['cart'] as $k=>$v)
                    {
                        if(isset($v))
                        {
                            $ok=2;
                        }
                    }
                }
                if ($ok != 2)
                {
                    echo 0;
                }else{ echo count($_SESSION['cart']); } ?></small></div>
			</a>
			
				<div class="dropdown-menu dropdown-menu-right">
					<?php 
						$ok=1;
						if(isset($_SESSION['cart']))
						{
							foreach($_SESSION['cart'] as $k => $v)
							{
								if(isset($k))
								{
									$ok=2;
								}
							}
						}
						if($ok == 2){
						  foreach($_SESSION['cart'] as $key=>$value)
						{
							$item[]=$key;
						}
						$str=implode(",",$item);
						$total=0;
						$connect=mysqli_connect("localhost","root","", "liquorstore") or die("Can not connect
						database");
						$sql="SELECT * FROM PRODUCTS WHERE id in ($str)";
						$query = mysqli_query($connect, $sql); 
						if(mysqli_num_rows($query)>3){
						for($i=0; $i<1; $i++){
							$row = mysqli_fetch_array($query);
					?>
						<div class="dropdown-item d-flex align-items-start" href="#">
							<div class="img" style="background-image: url(<?php echo $row['img']?>);"></div>
							<div class="text pl-3">
								<h4><?php echo $row['productname']?></h4>
								<p class="mb-0"><a href="#" class="price"><?php echo '$'.number_format($row['price'],2)?></a><span class="quantity ml-3">Quantity: <?php echo $value?></span></p>
							</div>
						</div>
						<?php }}else{
							while($row = mysqli_fetch_array($query)){
						?>
						<div class="dropdown-item d-flex align-items-start" href="#">
							<div class="img" style="background-image: url(<?php echo $row['img']?>);"></div>
							<div class="text pl-3">
								<h4><?php echo $row['productname']?></h4>
								<p class="mb-0"><a href="#" class="price"><?php echo '$'.number_format($row['price'],2)?></a><span class="quantity ml-3">Quantity: <?php echo $value?></span></p>
							</div>
						</div>
							<?php }}}else{?>
							<div class="dropdown-item d-flex align-items-start" href="#">
								<div class="text pl-3">
									<h4><?php echo 'Your cart is empty'?></h4>
								</div>
							</div>
						<?php }?>
						<a class="dropdown-item text-center btn-link d-block w-100" href="cart.php">
							View All
							<span class="ion-ios-arrow-round-forward"></span>
						</a>
				</div>
        	</div>
			
			<?php 
				if(isset($_SESSION['user'])){
			?>
						<div class="order-lg-last" style="margin-left: 30px">
							<div class= "user-img dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-image: url(<?php echo $_SESSION['avatar']?>); border-radius: 50%; cursor: pointer; width: 50px; height: 50px">
							</div>
							<div class="dropdown-menu" style="left: auto">
								<?php if($_SESSION['role']==="admin"){?>
									<div class="dropdown-item d-flex align-items-start" href="#">
										<a href="./startbootstrap-sb-admin-gh-pages/dist/index.php" style="cursor: pointer;">Manage</a>
									</div>
								<?php }?>
								<div class="dropdown-item d-flex align-items-start" href="#">
										<a href="salelist.php" style="cursor: pointer;">Manage Receipt</a>
									</div>
								<div class="dropdown-item d-flex align-items-start" href="#">
									<a href="logout.php" style="cursor: pointer;">Log Out</a>
								</div>
							</div>
						</div>
			<?php 
				}
			?>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="/liquorstore" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	          <li class="nav-item dropdown active">
              <a class="nav-link" href="product.php?idcate=">Products</a>
            </li>
	          <li class="nav-item	"><a href="blog.php" class="nav-link">Blog</a></li>
			  <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
