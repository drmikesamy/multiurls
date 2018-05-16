<?php
session_start();
setcookie("ccheck","good");

//change the following directory to somewhere outside the root directory
include "config/config.php";
include "includes/ldb.php";

if(isset($_COOKIE['mbusername']) && isset($_COOKIE['mbrh']) && empty($_SESSION['username']))
{
  $una = cleanvars($_COOKIE['mbusername']);
  $findhash = mysqli_query($mc, "SELECT autohash FROM user_data WHERE username = '$una'");
  $hashr = mysqli_fetch_row($findhash);
  if($hashr[0] == $_COOKIE['mbrh'])
  {
    $_SESSION['username'] = cleanvars($_COOKIE['mbusername']);
  }
}
if($_GET['p'] != "signin" && $_GET['p'] != "register" && $_GET['p'] != "save" && $_GET['p'] != "sitelist" && $_GET['p'] != "")
{
  $_SESSION['lastviewed'] = "index.php?p=".$_GET['p'];
}
if($_GET['p'] == "save")
{
  $_SESSION['lastviewed'] = "index.php?p=savedsites";
}
if($_GET['p'] == "")
{
  $_SESSION['lastviewed'] = "index.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>multiurls :: Social [Multi] Bookmarking<?php if($_GET['p']=="sitelist"){echo " - Viewing Site List";}if($_GET['p']=="savedsites"){echo " - Saved Sites";}?></title>
  <link rel="stylesheet" type="text/css" href="style/style.css" />
  <script src="js/ifs.js"></script>
  <script src="js/common.js"></script>
  <?php
  if(!$_COOKIE["ccheck"]){
    if($_GET['cookies'] == "d")
    {
      $ckcheck = "false";
    }else{
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?cookies=d\"";
    }
  }
  ?>
</head>
<body onload="<?php

if($_GET['p'] == "editor")
{
  echo "setnou();";
}
elseif($_GET['p'] == "saveonly")
{
  echo "moveToForm();";
}
elseif($_GET['p'] == "")
{
  echo "show(0);show(1);show(2);setZero();";
}

?>">
<?php
if($ckcheck == "false" && !$_COOKIE["ccheck"])
{
  echo "Your browser does not appear to accept cookies. Multiurls cannot function correctly without them.";
}
?>
<div id="logo"></div>
<div id="linkbar"><?php include "includes/mainnav.php"; ?></div>
<div id="separators"></div>
<?php
function cleanvars($thevar)
{
  $thevar = addslashes(trim($thevar));
  return $thevar;
}
if($_GET['p'] != "sitelist")
{
  echo "<div id=\"content\">";
}
if(file_exists("pages/".$_GET['p'].".php"))
{
  include 'pages/'.cleanvars($_GET['p']).'.php';
}
else if($_GET['p'] == "" || $_GET['p'] == "start")
{
  include "pages/start.php";
  echo "</div><div id=\"content\">";
  include "pages/recentsaves.php";
}
else{
  include "pages/404.php";
}
?>
</div>
<div id="linkbar"><?php include "includes/footer.php"; ?></div>
<div id="signinout"><?php if($_GET['p'] != "signout"){if($_SESSION['username'] == ""){include "includes/sirlink.php";}else{include "includes/lilink.php";}}?></div>
<br />
<?php
#print_r($_SESSION);

  include "includes/cdb.php";
?>
</body>
</html>
