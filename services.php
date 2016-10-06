<?php

// pull in the config
require('config.php');

class services {
  var $LINK;

  // internal variables
  var $SQL = Array();

  function services() {
    global $_SET;

    // start a new session
    session_start();

    // pull in detail from the config
    $this->SQL = $_SET;

    // connect to the database
    $this->LINK = mysqli_connect($this->SQL['hostname'], $this->SQL['username'], $this->SQL['password'], $this->SQL['database'])
     or die('Unable to connect to database.');
  }

  function login($USERNAME, $PASSWORD) {
    $QUERY = $this->LINK->query("SELECT nick_id, nick, level, created, email, password FROM ". $this->SQL['tb_user'] ." WHERE (nick = '". $USERNAME ."')");

    $DATA = mysqli_fetch_array($QUERY);
    if ($PASSWORD === $DATA['password']) {
      $_SESSION['user_id'] = $DATA['nick_id'];
      $_SESSION['username'] = $DATA['nick'];
      $_SESSION['level'] = $DATA['level'];
      $_SESSION['email'] = $DATA['email'];
      return true;
    } else {
      return false;
    }
  }

  function userinfo($USERNAME, $FIELD) {
    $QUERY = $this->LINK->query("SELECT ". $FIELD ." FROM ". $this->SQL['tb_user'] ." WHERE (nick = '". $USERNAME ."')");

    $DATA = mysqli_fetch_array($QUERY);

    return $DATA[$FIELD];
  }

  function userlink($USERNAME) { // As Array()
    $QUERY = $this->LINK->query("SELECT altnick FROM nicklink WHERE (nick = '". $USERNAME ."')");

    $RETURN = null;

    while ($DATA = mysqli_fetch_array($QUERY)) {
      $RETURN[$DATA['altnick']] = $DATA['altnick'];
    }

    return $RETURN;
  }

  function color($TEXT) {
    $PATTERN = Array(
      '/\/002\/(.+)\/002\//',
      '/\/029\/(.+)\/029\//',
      '/\/031\/(.+)\/031\//',
      '/\/040\//',
      '/\/041\//'
    );
    $REPLACE = Array(
      '<strong>$1</strong>',
      '<u>$1</u>',
      '<i>$1</i>',
      '(',
      ')'
    );
    return preg_replace($PATTERN, $REPLACE, $TEXT);
  }
  
  function connects($LIMIT=100) {
    $QUERY = $this->LINK->query("SELECT * FROM svr_connect ORDER BY timestamp DESC");

    return $QUERY;
  }

  function chanlist($NICK='', $ACCESS='0') {
    $QUERY = $this->LINK->query("SELECT chaninfo.chan_id, chanaccess.chan, chanaccess.level, chanaccess.aop, chanaccess.aoh, chanaccess.aov FROM chaninfo, chanaccess WHERE (chaninfo.chan = chanaccess.chan) AND (nick = '$NICK') AND (level >= '$ACCESS') ORDER BY level");

    $RETURN = null;

    while ($DATA = mysqli_fetch_array($QUERY)) {
      $RETURN[$DATA['chan']] = Array(
        'chan_id' => $DATA['chan_id'],
        'chan' => $DATA['chan'],
        'level' => $DATA['level'],
        'aop' => $DATA['aop'],
        'aoh' => $DATA['aoh'],
        'aov' => $DATA['aov']
      );
    }

    return $RETURN;
  }

  function chaninfo($CHAN) {
    $QUERY = $this->LINK->query("SELECT * FROM chaninfo WHERE (chan = '$CHAN')");

    $RETURN = null;

    while ($DATA = mysqli_fetch_array($QUERY)) {
      $RETURN = Array(
        'chan' => $DATA['chan'],
        'created' => $DATA['created'],
        'owner' => $DATA['owner'],
        'topic' => $DATA['topic'],
        'topicnick' => $DATA['topicnick'],
        'topiccreated' => $DATA['topiccreated'],
        'peak' => $DATA['peak']
      );
    }

    return $RETURN;
  }


}
?>















