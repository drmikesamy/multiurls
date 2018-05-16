<b>What others are saving:</b> <br /><br />

<?php
include "d48378/config.php";
include "includes/ldb.php";

$msql = "SELECT * FROM user_URLs WHERE private='false' ORDER BY tstamp DESC LIMIT 3";

$findurl = mysql_query($msql);

while($fu=mysql_fetch_array($findurl))
{
echo "<div id=\"slcontainer\"><div id=\"slurlinfo\"><font class=\"smallfont\"><a href=\"index.php?p=sitelist&nou=$fu[nou]";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "&".$i."=".$fu["url".$i];
}
$numberurls = $fu[nou] + 1;
echo "&collapse=$fu[collapse]\">$fu[grouptitle]</a></font>";
if($fu['private'] == "true"){echo " <font class=\"smallred\">(private)</font>";}
if($fu[groupdescription] != ""){ echo "<br />"; }
echo "<font class=\"smallfont\">$fu[groupdescription]</font><br/><font class=\"smallgrey\">".date("D F j, Y, g:i a",strtotime($fu[tstamp]))." | $numberurls URLs (<a class=\"fl\" onclick=\"toggleshow('sublink$fu[eid]');\">Show/Hide</a>) | Posted by <a href=index.php?p=search&u=$fu[uname]>$fu[uname]</a></font></div></div>\n";
echo "<div class=\"urllist\" id=\"sublink$fu[eid]\"><font class=\"smallfont\">";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "<a href=\"".$fu["url".$i]."\" target=\"_blank\">".$fu["url".$i]."</a><br />";
}
echo "</font></div><br />";
}
?>
