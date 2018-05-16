<b>Register</b><br /><br />

<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
if(!empty($_SESSION['ts']) && !empty($_POST['t']) && $_SESSION['ts'] == $_POST['t'] && $_SESSION['ttstamp'] > (time() - 360))
{
include "d48378/config.php";
include "includes/ldb.php";

$un = cleanvars($_POST['uname']);
$pw = cleanvars($_POST['pword']);
$pw2 = cleanvars($_POST['pword2']);
$ea = cleanvars($_POST['email']);

echo "<font class=\"error\">";


$finduser = mysql_query("SELECT username FROM user_data WHERE username = '$un'");
$namesr = mysql_fetch_row($finduser);
if(strlen($un) < 4)
{
$ungood = "false";
echo "Usernames must be at least 4 characters long.<br />";
}
elseif($namesr[0] == $un)
{
echo "This username has already been taken. Please choose another one.<br />";
}
else{
$ungood = "true";
}

if($pw != $pw2)
{
$pwgood = "false";
echo "The passwords you entered do not match.<br />";
}
elseif((strlen($pw)+strlen($pw2)) < 12)
{
$pwgood = "false";
echo "Passwords must be at least 6 characters long.<br />";
}
else{
$pwgood = "true";
$pwhash = md5($pw);
}

if($ea == "")
{
echo "Please enter a valid email address.<br />";
}
else
{
$emgood = "true";
}

echo "</font>";

if($ungood == "true" && $pwgood == "true" && $emgood == "true")
{
$insertudata = "INSERT INTO user_data (username, password, eaddress) VALUES ('$un', '$pwhash', '$ea')";
mysql_query($insertudata, $mc);
if($_SESSION['secollapse']){
echo "Thank you for registering. Please sign in below to continue saving your site list.<br /><br />";
}else{
echo "Thank you for registering. Please sign in below to go back to the page you were at.<br /><br />";
}
include "pages/signin.php";
}
else
{
$reenter = "true";
echo "<br />";
}
include "includes/cdb.php";
}
else
{
echo "<font class=\"error\">There was an error with the form. Please try again.<br /><br /></font>";
$reenter = "true";
}
}

if($_SERVER['REQUEST_METHOD'] != "POST" OR $reenter == "true")
{
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
include "includes/regform.php";
}
?>