<?php
  require('services.php');
  $services = new services();


?>
Registered channels:
<?php
  $query = $services->LINK->query('SELECT * FROM chaninfo');
  while ($data = mysqli_fetch_array($query)) {
    echo '<a href="viewchan.php?id='. $data['chan_id'] .'">'. $data['chan'] .'</a> ';
  }
?>
<br />
<br />
Registered nicknames:
<?php
  $query = $services->LINK->query('SELECT * FROM nickinfo');
  while ($data = mysqli_fetch_array($query)) {
    echo '<a href="viewnick.php?id='. $data['nick_id'] .'">'. $data['nick'] .'</a> ';
  }
?>