<?php
include 'base.inc';
$isMobile = false;

if (isset($_GET['m'])) {                            // We have a value directly from the user that we need to store
  setcookie('m', $_GET['m'], time()+60*60*24*30);   // Although we may already have a cookie, the value may
  $_COOKIE['m'] = $_GET['m'];                       // have changed so we'll store it anyway. Also update $_COOKIE array.
}

if ($_COOKIE['m']  > 0 ) {                          // If we have a cookie set to 1 or if we have
  $isMobile = true;                                 // just set it to 1, we want the mobile view
}

header("Cache-Control: max-age=60");                // Set cache control before we go any further

if (!isset($_COOKIE['m'])) {                        // No indication of user preference
  include("Mobile_Detect.php");                     // include the detector script
  $detect = new Mobile_Detect();
  if ($detect->isMobile()) {                        // Increment the mobile_browser variable if we're on mobile
      $isMobile = true;
  }
}                                                   //OK, we're done. We know which version we want so let's return it

$styles = "css/desktop_styles.php";
$viewport = "";
if ($isMobile) {
  $viewport = "<meta name='viewport' content='width=device-width' />";
  $styles = "css/mobile_styles.php";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en" manifest="winner.appcache">
<head>
  <title>Who's the lucky winner?</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <?php echo $viewport; ?>
  <link rel="icon" type="image/ico" href="imgs/icon.ico" />
  <link rel="canonical" href="<?php echo $base; ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo $styles; ?>" />
</head>
<body>
  <div id="allContent">
    <h1><?php if (!$isMobile) { ?><img id="top_img" src="imgs/question_dice.jpg" /><?php } ?>Who's the lucky winner?</h1>
    <div id="mainContent">
      <div id="firstWrapper" class="wrapper">
        <div>Can't decide who should clean the bathroom next? Not sure what to eat for dinner? Don't worry one more minute--simply let our randomizer choose for you!</div>
      </div>
      <div class="wrapper">
        <h2>Create New Group</h2>
        <div>Group name:</div>
        <div id="grpWrap"><input id="grp" type="text" required="required"/></div>
        <div>Names: (separate with spaces)</div>
        <div id="itemsWrap"><textarea id="items" required="required"></textarea></div>
        <div><input type="button" value="Create Group" onclick="createGroup();" /><span id="createGroupMessage"></span></div>
      </div>
      <div class="wrapper">
        <h2>Find a Winner!</h2>
        <div id="savedGrps">
        </div>
        <div id="winnerButtonWrapper"><input id="getWinnerButton" type="button" value="Get a winner!" onclick="roll();" /></div>
      </div>
      <div class="wrapper">
        <div>When you can't decide, choose the decision app.</div>
        <?php if ($isMobile) { ?>
        <div class="small">Made to display on mobile. <span><a href="<?php echo $base; ?>?m=0">Desktop View</a></span></div>
        
        <?php } else { ?>
        <div class="small">Made to display on a desktop. <span><a href="<?php echo $base; ?>?m=1">Mobile View</a></span></div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- including last to improve perceived performance -->
  <script type="text/javascript" src="js/3rdParty.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>
</html>