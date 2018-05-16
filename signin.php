<?php
session_start();
function cleanvars($thevar)
{
$thevar = addslashes(trim($thevar));
return $thevar;
}
if(!empty($_SESSION['ts']) && !empty($_POST['t']) && $_SESSION['ts'] == $_POST['t'] && $_SESSION['ttstamp'] > (time() - 360))
{
if($_SERVER['REQUEST_METHOD'] == "POST")
{
include "d48378/config.php";
include "includes/ldb.php";

$un = cleanvars($_POST['uname']);
$pw = cleanvars($_POST['pword']);

$finduser = mysql_query("SELECT username FROM user_data WHERE username = '$un'");
$namesr = mysql_fetch_row($finduser);
$findpass = mysql_query("SELECT password FROM user_data WHERE username = '$un'");
$passr = mysql_fetch_row($findpass);
if($namesr[0] == $un)
{
$ungood = "true";
}
if($passr[0] == md5($pw))
{
$pwgood = "true";
}

if($ungood == "true" && $pwgood == "true")
{
$_SESSION['username'] = $un;

$lastviewed = $_SESSION['lastviewed'];
if(empty($lastviewed))
{
header("Location: index.php");
}
else
{
header("Location: ".$lastviewed);
}
if(isset($_POST['remember']))
{
$rh = md5(uniqid(rand(),true));
mysql_query("UPDATE user_data SET autohash='$rh' WHERE username='$un'");
setcookie('mbusername', $un, time()+60*60*24*365);
setcookie('mbrh', $rh, time()+60*60*24*365);
}
}
else
{
header("Location: index.php?p=signin&upe=true");
}
include "includes/cdb.php";
}
}
else
{
header("Location: index.php?p=signin&se=true");
}
?>