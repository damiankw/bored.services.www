<?php
  require_once('services.php');

  $services = new services();

  if (isset($_POST['submit'])) {
    if ($services->login($_POST['username'], $_POST['password'])) {
      header('Location: index.php');
    } else {
      echo 'You failed authentication.';
    }
  }
?>
  <form method="post" action="login.php">
    username; <input type="text" name="username" /><br />
    password; <input type="text" name="password" /><br />
    <input type="submit" name="submit" value="Login!" />
  </form>
<?php
?>