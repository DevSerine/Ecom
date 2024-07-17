<?php
// Assurez-vous que session_start() est appelé au début de chaque page utilisant des sessions
session_start();

@include 'config.php';

if(isset($_POST['submit'])){
    $error = array(); // Initialize an empty array for errors

    // Check if all required fields are set and not empty
    if(isset($_POST['email']) && !empty($_POST['email']) &&
       isset($_POST['password']) && !empty($_POST['password'])){

        // Escape user input to prevent SQL injection
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);

        // Perform the query
        $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$pass'";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);

            if($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                header('location: /php admin crud/admin_page.php');
                exit; // Stop script execution after redirecting
            } elseif($row['user_type'] == 'user'){
                $_SESSION['user_name'] = $row['name'];
                header('location: /php admin crud/first.php');
                exit; // Stop script execution after redirecting
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Email and password are required!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login now" class="form-btn">
      <p>Forgot password? <a href="otp_verification.php">Here!</a></p>
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
</div>

</body>
</html>
