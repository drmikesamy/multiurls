<?php
if($_POST['collapse'] != "")
{
$_SESSION[senou] = cleanvars($_POST['nou']);
for($i=0;$i<15;$i++)
{
$_SESSION[url.$i] = cleanvars($_POST[urlbox.$i]);
}
$_SESSION['secollapse'] = cleanvars($_POST['collapse']);
}

if($_SESSION['username'] != "" && $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['t'] == $_SESSION['ts'] && $_SESSION['ttstamp'] > (time() - 360) && $_POST['sgtitle'] != "")
{
$runinsert = "true";
}
elseif($_SESSION['username'] != "" && $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['t'] == $_SESSION['ts'] && $_SESSION['ttstamp'] > (time() - 360) && $_POST['sgtitle'] == "")
{
echo "<font class=\"error\">You must enter a title to save a site group.</font><br /><br /><br />";
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
include "includes/addsitelist.php";
}
elseif($_SESSION['username'] != "" && $_GET['sh'] == $_SESSION['slts'] && $_GET['tss'] == $_SESSION['slttstamp'])
{
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
include "includes/addsitelist.php";
}
elseif($_SESSION['username'] != "" && $_POST['sh'] == $_SESSION['slts'] && $_POST['tss'] == $_SESSION['slttstamp'])
{
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
include "includes/addsitelist.php";
}
elseif($_SESSION['username'] == "" && $_POST['sh'] == $_SESSION['slts'] && $_POST['tss'] == $_SESSION['slttstamp'])
{
$_SESSION['lastviewed'] = "index.php?p=save&sh=".$_SESSION['slts']."&tss=".$_SESSION['slttstamp'];
echo "You are not signed in.<br /><br />";
include "pages/signin.php";
}
else
{
echo "<a href=\"index.php\">Click here</a> to go to the home page.";
}

if($runinsert == "true")
{
include "d48378/config.php";
include "includes/ldb.php";
$uname = $_SESSION['username'];
$grouptitle = cleanvars($_POST['sgtitle']);
$groupdescription = cleanvars($_POST['sgdescription']);
$isprivate = cleanvars($_POST['private']);
$cdt = date("Y-m-d H:i:s");

$cl = array();
switch($isprivate)
{
case 'true';
case 'false';
$cl['private'] = $isprivate;
break;
}
$isprivate = $cl['private'];
$cl = array();
switch($_SESSION['collapse'])
{
case 'true';
case 'false';
$cl['collapse'] = $_SESSION['collapse'];
break;
}
$_SESSION['collapse'] = $cl['collapse'];

$inserturl = "INSERT INTO user_URLs (uname, grouptitle, groupdescription, nou, url0, url1, url2, url3, url4, url5, url6, url7, url8, url9, url10, url11, url12, url13, url14, collapse, private, tstamp) VALUES ('$uname', '$grouptitle', '$groupdescription', '$_SESSION[senou]', '$_SESSION[url0]', '$_SESSION[url1]', '$_SESSION[url2]', '$_SESSION[url3]', '$_SESSION[url4]', '$_SESSION[url5]', '$_SESSION[url6]', '$_SESSION[url7]', '$_SESSION[url8]', '$_SESSION[url9]', '$_SESSION[url10]', '$_SESSION[url11]', '$_SESSION[url12]', '$_SESSION[url13]', '$_SESSION[url14]', '$_SESSION[secollapse]', '$isprivate', '$cdt')";
mysql_query($inserturl, $mc);
include "includes/cdb.php";
$_SESSION['ts'] = "";
$_SESSION['ttstamp'] = "";
$_SESSION['secollapse'] = "";
include "pages/savedsites.php";
}
?>