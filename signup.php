<?php 
	$username = '';
    $password = '';
    $retype_password = '';
    $username_error = '';
    $password_error = '';
    $retype_password_error = '';
    $username_exist_error = '';
	if($_SERVER["REQUEST_METHOD"]=="POST"){
        $username=$_POST['name'];
        $password=$_POST['pass'];
        $retype_password=$_POST['re_pass'];
		if ($username === '') {
			$username_error = "Please enter your username";
		}
		else{
			if ($password === '') {
				$password_error = "Please enter your password";
			}else{
				if(!($password === $retype_password)){
					$retype_password_error = "Please retype your password exactly";
				}else{
					$password = md5($_POST['pass']);	
					$conn = mysqli_connect("localhost", "root", "", "liquorstore");
					$sql = "SELECT id FROM users WHERE username = '$username'";
					$result = mysqli_query($conn, $sql); 
					if(mysqli_num_rows($result)>0){
						$username_exist_error = "This username has been existed";
					}
					else{
						$sql = "INSERT INTO users(username, password, role, avatar) VALUES('$username', '$password', 'customer', 'images/noneava.jpg')";
						$result = mysqli_query($conn, $sql); 
						header('Location: login.php');
					}
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <link rel="stylesheet" href="./Signup_Login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="./Signup_Login/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form action="signup.php" method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <span style="color: red"><?php echo $username_error?></span>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <span style="color: red"><?php echo $password_error?></span>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <span style="color: red"><?php echo $retype_password_error?></span>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="./Signup_Login/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="./Signup_Login/vendor/jquery/jquery.min.js"></script>
    <script src="./Signup_Login/js/main.js"></script>

</body>
</html>