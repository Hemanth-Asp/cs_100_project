<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="link rel="preconnect href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">
           <img src="logo-removebg-preview.png" width="135px"> 
        </div>
        <nav>
            <ul id="menuitems">
                <li><a href="index.html">Home</a></li>
                <li><a href="Products.html">Products</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="cart.html">Cart<img src="cart.png" alt=""></a></li> 
            </ul>
        </nav>
        <img src="menu.png" class="menu" onclick="menuToggle()">
    </div> 
<div class="col-2">
 <div class="form-container">
    <div class="form-btn">
        <span onclick="login()">Login</span>
        <span onclick="register()">Register</span>
        <hr id="indicator">
    </div>

    
 

     <form id="Loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" placeholder="Username" id="login_username" value="login_username">
            <input type="password" placeholder="Password" id="login_password" value = "login_password" >
            <button type="submit" class="btn" name="login" value="login">Login</button>
            <a href="account.php">Forgot password</a>
      </form>


    


    <form id="Regform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" placeholder="Username" id="username">
        <input type="email" placeholder="Email" id="email" >
        <input type="password" placeholder="Password" id="password">
        <input type="password" placeholder="confirm password" id="confirm_password">
        <button type="submit" class="btn" name="register" value="register">Register</button>
    </form>
    
    <?php
	// check if form has been submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// check if registration form submitted
		if (isset($_POST["register"])) {

			// get username and password from form
			$username = $_POST["username"];
			$password = $_POST["password"];
			$email    = $_POST["email"];
			$confirm_password = $_POST["confirm_password"];

			// check if passwords match
			if ($password != $confirm_password) {
				echo "Passwords do not match.";
			} else {
				// open file and read contents into an array
				
				$file = fopen('users.txt', "r");
				$users = array();
				while (!feof($file)) {
					$line = fgets($file);
					if ($line) {
						$user = explode(":", $line);
						$users[$user[0]] = rtrim($user[1]);
					}
				}
				fclose($file);

				// check if username already exists
				if (isset($users[$username])) {
					echo "Username already exists.";
				} else {
					// add new user to array and write to file
					$users[$username] = $password;
					$file = fopen('users.txt', "a+");
					fwrite($file, "$username:$password:$email\n");
					fclose($file);

					echo "Registration successful!";
				}
			}
		}

		// check if login form submitted
		if (isset($_POST["login"])) {
			echo $_POST["login_username"];
			// get username and password from form
			$login_username = $_POST["login_username"];
			$login_password = $_POST["login_password"];

			// open file and read contents into an array
			$filename = "users.txt";
			$file = fopen($filename, "r");
			$users = array(); 
			while (!feof($file)) {
				$line = fgets($file);
				if ($line) {
					$user = explode(":", $line);
					$users[$user[0]] = rtrim($user[1]);
				}
			}
			fclose($file);
			
			// check if username and password match
			if (isset($users[$login_username]) && $users[$login_username] == $login_password) {
				echo "Login successful!";
				
				header("Location: http://localhost/cs100_project/Products.html");  

			} else {
				echo "Invalid username or password.";
				//header("Location: http://localhost/cs100_project/account.php"); 
			}

		}
	}
?>


    

  
</div>
</div>
<script>
    var Loginform = document.getElementById("Loginform");
    var Regform = document.getElementById("Regform");
    var indicator = document.getElementById("indicator")

        function register(){
            Regform.style.transform = "translateX(0px)";
            Loginform.style.transform = "translateX(0px)";
            indicator.style.transform = "translateX(100px)";
        }
        function login(){
            Regform.style.transform = "translateX(300px)";
            Loginform.style.transform = "translateX(300px)";
            indicator.style.transform = "translateX(0px)";
        }
</script>
<script>
    var menuitems = document.getElementById("menuitems");
    menuitems.style.maxHeight="0px";
    function menuToggle(){
        if(menuitems.style.maxHeight=="0px"){
            menuitems.style.maxHeight="200px"
        }
        else{
            menuitems.style.maxHeight="0px"
        }
    }
</script>
</body>
</html>
