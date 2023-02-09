<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include 'partials/_dbconnect.php';
      $username = $_POST["username"];
      $password = $_POST["password"];
      $cpassword = $_POST["cpassword"];
      // $exists = false;

      // Chech whether  this username Exists
      $existsSql = "SELECT * FROM `users` WHERE username = '$username'";
      $result = mysqli_query($conn, $existsSql);
      $NumExistsRow = mysqli_num_rows($result);
      if ($NumExistsRow > 0) {
            // $exists = true;
            $showError = "Username Already Exists";
      } else {
            // exists = false;
      }
      if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                  $showAlert = true;
            }
      } else {
            $showError = "Passwords do not match";
      }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sign Up</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
      <?php require 'partials/_nav.php' ?>
      <?php
      if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your account is now created and you can LogIn.
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
            <h1 class="text-center">Sign Up to our Clinic</h1>
            <form action="/loginsystem/signup.php" method="post">
                  <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" maxlength="11" class="form-control" id="username" name="username"
                              placeholder="username" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                              placeholder="password">
                  </div>
                  <div class="mb-3 col-md-6">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword"
                              placeholder="cpassword">
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
                  </div>
                  <button type="submit" class="btn btn-primary">SignUp</button>
            </form>
      </div>
</body>

</html>