<?php

@include 'Conectare.php';

if (isset($_POST['submit'])) {

    $nume = mysqli_real_escape_string($conn, $_POST['nume']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $parola = md5($_POST['parola']);
    $cparola = md5($_POST['cparola']);
    $tip = $_POST['tip'];

    $select = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($parola != $cparola) {
            $error[] = 'Passwords do not match!';
        } else {
            $insert = "INSERT INTO user (nume, email, parola, tip) VALUES ('$nume', '$email', '$parola', '$tip')";
            mysqli_query($conn, $insert);
            header('location: login.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>
<body>

<div class="form-container">

    <form action="" method="post">
        <h3>Register Now</h3>
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>
        <input type="text" name="nume" required placeholder="Enter your name">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="parola" name="parola" required placeholder="Enter your parola">
        <input type="parola" name="cparola" required placeholder="Confirm your parola">
        <select name="tip">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" name="submit" value="Register Now" class="form-btn">
        <p>Already have an account? <a href="login.php">Login Now</a></p>
    </form>

</div>

</body>
</html>
