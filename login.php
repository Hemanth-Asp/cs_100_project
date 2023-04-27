<!DOCTYPE html>
<html>
  <head>
    <title>Log In Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
  </head>
  <body>
    <div class="container">
      <h1>Log In</h1>
      <form action="login.php" method="POST">
        <label for="username_or_email">Username or email</label>
        <input type="text" id="username_or_email" name="username_or_email" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    $filename = 'users.txt';
    $valid_user = false;

    // Check if user exists and password is correct
    $users = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($name, $existing_email, $existing_password) = explode('|', $user);
        if (($existing_email == $email_or_username || $name == $email_or_username) && $existing_password == $password) {
            $valid_user = true;
            break;
        }
    }

    // If user is valid, redirect to dashboard
    if ($valid_user) {
        header('Location: Products.html');
        exit;
    } else {
        $error_message = "Invalid email/username or password.";
    }
}
?>


        <button type="submit">Log In</button>
      </form>
    </div>
  </body>
</html>
