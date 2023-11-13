<?php
@include 'config.php';
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $select = "SELECT * FROM user_form WHERE email='$email'&& password='$pass'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $error[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name,email,password,user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <title>Signup</title>
</head>
<body>
<div class="container-login">
        <h2>Login Page</h2><br/>
        <div class="form-container">
            <form action="" method="post">
                <label for="email">E-mail</label>
                <input type="email" name="email" required>
                <label for="Username">Username</label>
                <input type="text" name="Username" required>
                <label for="password">Password</label>
                <input type="password" name="password" required>
                <input type="submit" id="submit" value="register">
            </form>
            <span>Already Have Account ? <a href="login.php">Login now</a></span>
        </div>
    </div>
</body>
</html>