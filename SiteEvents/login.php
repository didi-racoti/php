<?php
@include 'Conectare.php';

session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $parola = md5($_POST['parola']);

   $select = "SELECT * FROM user WHERE email = '$email' AND parola = '$parola'";
   $result = mysqli_query($conn, $select);

   if($result) {
      if(mysqli_num_rows($result) > 0){
         $row = mysqli_fetch_assoc($result);

         if($row['tip'] == 'admin'){
            $_SESSION['admin_name'] = $row['nume'];
            header('location: HomeAdministrator.php');
            exit();
         } elseif($row['tip'] == 'user'){
            $_SESSION['user_name'] = $row['nume'];
            header('location: HomeUser.php');
            exit();
         }
      } else {
         $error[] = 'Incorrect email or password!';
      }
   } else {
      $error[] = 'Query error: ' . mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="parola" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login now" class="form-btn">
      <p>Don't have an account? <a href="inregistrare.php">Register now</a></p>
   </form>
</div>

</body>
</html>
