<?php
  require_once('services.php');

  $services = new services();
?>
<div style="font-family: Calibri; font-size: 10pt;">
Welcome <?php echo $_SESSION['username']; ?>! Your email address is <?php echo $_SESSION['email']; ?> and your services access level is <?php echo $_SESSION['level']; ?>.
<br />
Enjoy your stay.

<hr />



<table border="1" style="font-size: 8pt">
  <tr>
    <th>GLINE</th>
    <th>NickName</th>
    <th>User</th>
    <th>Host></th>
    <th>RealName</th>
    <th>Server</th>
    <th>Connected</th>
  </tr>
<?php
  $USERS = $services->connects();

  if (mysqli_num_rows($USERS) == 0) {
    echo '<tr><td colspan="6">Found no connections</td></tr>';
  } else {
    while ($DATA = mysqli_fetch_array($USERS)) {
      echo '<tr>';
      echo '<td><a href="connect.php?bu=">U@*</a> | <a href="connect.php?buh=">U@H</a> | <a href="connect.php?bh">*@H</a></td>';
      echo '<td>'. $DATA['nick'] .'</td>';
      echo '<td>'. $DATA['user'] .'</td>';
      echo '<td>'. $DATA['host'] .'</td>';
      echo '<td>'. $DATA['realname'] .'</td>';
      echo '<td>'. $DATA['server'] .'</td>';
      echo '<td>'. date('r', $DATA['timestamp']) .'</td>';
      echo '</tr>';

    }
  }
?>






