<?php
  require_once('services.php');

  $services = new services();
?>
<div style="font-family: Calibri; font-size: 10pt;">
Welcome <?php echo $_SESSION['username']; ?>! Your email address is <?php echo $_SESSION['email']; ?> and your services access level is <?php echo $_SESSION['level']; ?>.
<br />
Enjoy your stay.

<hr />

Your nickname is currently linked to the following other nicknames:<br />
<ul>
<?php
  $USERS = $services->userlink($_SESSION['username']);

  if ($USERS == null) {
    echo '<li>You are not currently linked with any nicknames.';
  } else {
    foreach ($USERS as $USER) {
      echo '<li>'. $USER;
    }
  }
?>
</ul>

You currently have access in the following channels:<br />
<ul>
<?php
  $CHANS = $services->chanlist($_SESSION['username']);

  if ($CHANS == null) {
    echo '<li>You currently have no access anywhere.';
  } else {
    foreach ($CHANS as $CHAN) {
      echo '<li><a href="viewchan.php?id='. $CHAN['chan_id'] .'">'. $CHAN['chan'] .'</a> ('. $CHAN['level'] .')';
    }
  }
?>
</ul>

You are currently owner of the following channels:<br />
<ul>
<?php
  $CHANS = $services->chanlist($_SESSION['username'], 200);

  if ($CHANS == null) {
    echo '<li>You currently have no access anywhere.';
  } else {
    foreach ($CHANS as $CHAN) {
      $CHANINFO = $services->chaninfo($CHAN['chan']);
      echo '<li><a href="viewchan.php?id='. $CHAN['chan_id'] .'">'. $CHAN['chan'] .'</a> ('. $CHAN['level'] .')<br />';
      echo '<ul>';
      echo '<li>Topic: '. $services->color($CHANINFO['topic']);
      echo '<li>Topic set by '. $CHANINFO['topicnick'] .' on '. date('r', $CHANINFO['topiccreated']);
      echo '<li>Created: '. date('r', $CHANINFO['created']);
      echo '<li>Peak: '. $CHANINFO['peak'];
      echo '</ul>';
    }
  }
?>
</ul>








