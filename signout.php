<?php
session_start();
$lastviewed = $_SESSION['lastviewed'];
session_destroy();
setcookie('mbusername', '', time()-60*60*24*365);
setcookie('mbrh', '', time()-60*60*24*365);
if(empty($lastviewed))
{
header("Location: index.php");
}
else
{
header("Location: ".$lastviewed);
}
?>