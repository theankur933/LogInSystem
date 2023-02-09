<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include 'partials/_dbconnect.php';
      $username = $_POST["username"];
      $password = $_POST["password"];

      // $sql = "Select * from users where username = '$username' AND password = '$password'";
      $sql = "Select * from users where username = '$username'";
      $result = mysqli_query($conn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                  if (password_verify($password, $row['password'])) {
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $username;
                        header("location: welcome.php");
                  } else {
                        $showError = "Invalid Credential";
                  }
            }
      } else {
            $showError = "Invalid Credential";
      }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Log In</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
      <?php require 'partials/_nav.php' ?>
      <?php
      if ($login) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> You are Logged In.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      ?>

      <div class="container my-4">
            <h1 class="text-center">Log in to our Clinic</h1>
            <form action="/loginsystem/login.php" method="post">
                  <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="username"
                              aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                              placeholder="password">
                  </div>
                  <button type="submit" class="btn btn-primary">LogIn</button>
            </form>
      </div>
</body>

</html>