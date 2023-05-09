<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
  </head>
  <body>
    <div class="container">
      <h1>Sign Up</h1>
      <form method="POST" action="signup.php">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        
        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $filename = 'signup.txt';
    $user_exists = false;
    $passwords_match = false;

    // Check if user already exists
    $users = file($filename,FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($existing_name, $existing_email, $existing_password) = explode('|', $user);
        if ($existing_name == $name || $existing_email == $email) {
            $user_exists = true;
            break;
        }
    }

    // Check if passwords match
    if ($password == $confirm_password) {
        $passwords_match = true;
    }

    // If user doesn't exist and passwords match, add to file
    if (!$user_exists && $passwords_match) {
        $user_data = "$name|$email|$password\n";
        file_put_contents($filename, $user_data, FILE_APPEND);
        echo "Signup successful!";
        //add line break here...
        echo '<a href="login.html">Click here to Login--></a>';
      
        
    } elseif ($user_exists) {
        echo "User already exists with that name or email!!!";
    } else {
        echo "Passwords do not match.";
    }
}

?>

        <button type="submit" id="register" value="register">Sign Up</button>
      </form>
    </div>
  </body>
</html>



