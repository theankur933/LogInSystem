<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
      header("location: login.php");
      exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Welcome -
            <?php echo $_SESSION['username'] ?>
      </title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
      <?php require 'partials/_nav.php' ?>
      <div class="container my-3">
            <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Welcome -
                        <?php echo $_SESSION['username'] ?>
                  </h4>
                  <p>Hey, How are you doing? Welcome to our Clinic. You are logged in as
                        <?php echo $_SESSION['username'] ?>Aww yeah, you successfully read this important alert message.
                        This example
                        text is going to run a
                        bit longer so that you can see how spacing within an alert works with this kind of content.
                  </p>
                  <hr>
                  <p class="mb-0">Whenever you need to, be sure to logout <a href="/loginsystem/logout.php">this
                              link.</a>
                  </p>
            </div>
      </div>
</body>

</html>