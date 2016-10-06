<?php
  require('services.php');
  $services = new services();

  $query = $services->LINK->query("SELECT * FROM chaninfo, nickinfo WHERE (chaninfo.owner = nickinfo.nick) && (chan_id = ". $_GET['id'] .")");
  if (mysqli_num_rows($query) == 0) {
    die('no channel found');
  }
  $data = mysqli_fetch_array($query);

  $q = $services->LINK->query("SELECT COUNT(*) AS users FROM chanaccess WHERE (chan = '". $data['chan'] ."')");
  $d = mysqli_fetch_array($q);

?>
Channel Information for <?php echo $data['chan']; ?> (Peak: <?php echo $data['peak']; ?>)<br />
Registered To   : <?php echo $data['owner']; ?> (<?php list($user, $host, $vhost) = explode(' ', $data['userhost']); echo $user.'@'.$vhost; ?>)<br />
Channel Creation: <?php echo date('r', $data['created']); ?><br />
Channel Idle    : <?php echo time() - $data['idle']; ?>secs<br />
Manager Seen    : <?php echo time() - $data['manseen']; ?>secs<br />
Database Summary: <?php echo $d['users']; ?> entries, with <?php echo $data['quota']; ?> quota<br />
