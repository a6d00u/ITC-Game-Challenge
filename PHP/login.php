<?php

@include 'configuration.php';

session_start();

if (isset($_POST['submit'])) {

  $name = mysqli_real_escape_string($conn, $_POST['Username']);
  $email = mysqli_real_escape_string($conn, $_POST['e-mail']);
  $password = md5($_POST['password']);

  $select = " SELECT * FROM 'users' WHERE e-mail = '$email' && password = '$password' ";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    header('../index.html');

  } else {
    $error[] = 'incorrect email or password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/form.css?v=<?php echo time(); ?>">
  <title>AC-Login</title>
</head>

<body>
  <div class="home-btn">
  <a class="btn-outline-light" href="../index.html">Home</a>
  </div>
  <div class="container">
    <div class="form-container">
      <form action="login.php" method="post">
        <h3>Login to your Account</h3>
        <!--error mesg-->
        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
          }
        }
        ?>
        <!--error mesg-->

        <label for="E-mail">E-mail</label>
        <input type="email" name="E-mail" required />
        <label for="password">Password</label>
        <input type="password" name="password" required />
        <input type="submit" value="Login" id="submit" />
        <p>Don't Have an account? <a href="SignIn.php">Registre now</a></p>
      </form>
    </div>
  </div>
</body>

</html>