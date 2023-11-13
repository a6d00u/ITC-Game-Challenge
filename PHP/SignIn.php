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
    $error[] = 'Account already existe !';
  } else {
    $insert = " INSERT INTO users(Username,e-mail,password) VALUES('$name','$email','$password')";
    mysqli_query($conn, $insert);
    header('location:PHP/login.php');
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
  <title>AC-Registre</title>
</head>

<body>
  <div class="home-btn">
  <a class="btn-outline-light" href="../index.html">Home</a>
  </div>
  <div class="container">
    <div class="form-container">
      <form action="Signin.php" method="post">
        <h3>Create your Account</h3>
        <!--error mesg-->
        <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
          }
        }
        ?>
        <!--error mesg-->
        <label for="name">Username</label>
        <input type="text" name="Username" required minlength="5" maxlength="100" />
        <label for="e-mail">E-mail</label>
        <input type="e-mail" name="e-mail" required />
        <label for="password">Password</label>
        <input type="password" name="password" required />
        <input type="submit" value="Registre" id="submit" />
        <p>Already Have an account? <a href="login.php">Login now</a></p>
      </form>
    </div>
  </div>
</body>

</html>