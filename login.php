<?php
    session_start();
    $mess_error = '';
	if($_SERVER["REQUEST_METHOD"]=="POST"){
			$username = $_POST['your_name'];
			$pass = md5($_POST['your_pass']);
			$conn = mysqli_connect("localhost", "root", "", "liquorstore");
			$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				$_SESSION['user'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['iduser'] = $row['id'];
                $_SESSION['avatar'] = $row['avatar'];
				header('Location: /liquorstore');
			}
			else{
				$mess_error = "Username or pasword is wrong!";
				session_unset();
			}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="./Signup_Login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="./Signup_Login/css/style.css">
</head>
<body>
<?php 
 if(!isset($_SESSION['user'])){
?>
    <div class="main">        
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="./Signup_Login/images/signin-image.jpg" alt="sign up image"></figure>
                        <a href="signup.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log in</h2>
                        <form action="login.php" method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_name" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            <span style="color: red;"><?php echo $mess_error?></span>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php 
        }else{
            echo "da dang nhap";
        }
    ?>
    <script src="./Signup_Login/vendor/jquery/jquery.min.js"></script>
    <script src="./Signup_Login/js/main.js"></script>
</body>
</html>