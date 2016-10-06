<?php
  require('services.php');

  $services = new services();

  $query = $services->LINK->query("SELECT * FROM nickinfo WHERE (nick_id = ". $_GET['id'] .")");
  if (mysqli_num_rows($query) == 0) {
    die('no nick found');
  }
  $data = mysqli_fetch_array($query);
?>
Information for <?php echo $data['nick']; ?><br />
Last address: <?php list($user, $host, $vhost) = explode(' ', $data['userhost']); echo $user.'@'.$vhost; ?><br />
Last online : <?php echo date('r', $data['lastauth']); ?><br />
Registered  : <?php echo date('r', $data['created']); ?><br />
Mail Address: <?php echo $data['email']; ?><br />