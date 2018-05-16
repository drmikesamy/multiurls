<?php
if($_SESSION['username'] != "")
{
include "d48378/config.php";
include "includes/ldb.php";

$un = $_SESSION['username'];
$rp = cleanvars($_GET['rp']);

$cl = array();
switch($rp)
{
case '10';
case '25';
case '50';
case '100';
$cl['rp'] = $rp;
break;
}

$rp = $cl['rp'];

$st = cleanvars($_GET['st']);

$cl = array();

if($st == strval(intval($st)))
{
$cl['st'] = $st;
}

$st = $cl['st'];

$ob = cleanvars($_GET['ob']);

$cl = array();
switch($ob)
{
case 'nou';
case 'tstamp';
case 'grouptitle';
$cl['ob'] = $ob;
break;
}

$ob = $cl['ob'];

$ad = cleanvars($_GET['ad']);

$cl = array();
switch($ad)
{
case 'asc';
case 'desc';
$cl['ad'] = $ad;
break;
}

$ad = $cl['ad'];

if($rp != ""){$_SESSION['range'] = $rp;}
if($rp == "" && $_SESSION['range'] != ""){$rp = $_SESSION['range'];}
if($rp == "" && $_SESSION['range'] == ""){$rp = 10;$_SESSION['range'] = 10;}
if($st == ""){$st = 0;}

$urlstart = "\"index.php?p=savedsites";

$addgroupbutton = "<input type=\"button\" value=\"Add new\" class=\"button\" onclick=\"javascript:top.location.href='index.php';\">";



echo "<b>My Saved Sites</b><br /><br />";

$msql = "SELECT * FROM user_URLs WHERE uname = '$un'";
$msql .= " ORDER BY ";
if($ob != "")
{
$msql .= "'$ob'";
}else{
$msql .= "'tstamp'";
}
if($ad != "")
{
$msql .= " $ad";
}else{
$msql .= " DESC";
}
$msql .= " LIMIT $st,";
$msql .= $rp;
$findurl = mysql_query($msql);
$numresults = mysql_num_rows($findurl);

if($numresults == "0")
{
echo "<font color=\"#333333\">(No saved sites)</font><br /><br />".$addgroupbutton;
}
else
{
echo "Order by ";

echo "<a href=\"index.php?p=savedsites&ob=grouptitle&ad=";
if($ob == "grouptitle" && $ad != "desc"){echo "desc";}else{echo "asc";}
echo "&st=$st&rp=$rp\">Title</a> | ";

echo "<a href=\"index.php?p=savedsites&ob=tstamp&ad=";
if($ob == "tstamp" && $ad != "asc"){echo "asc";}else{echo "desc";}
echo "&st=$st&rp=$rp\">Date added</a> | ";

echo "<a href=\"index.php?p=savedsites&ob=nou&ad=";
if($ob == "nou" && $ad != "asc"){echo "asc";}else{echo "desc";}
echo "&st=$st&rp=$rp\">Number of URLs</a>";

echo "<br />";

$msql = mysql_query("SELECT * FROM user_URLs WHERE uname = '$un'");
$numresults = mysql_num_rows($msql);

if($numresults >= 11)
{

echo "<br />Number of results per page ";
foreach(array(10,25,50,100) as $i)
{
if($rp != $i)
{
echo "<a href=\"index.php?p=savedsites&ob=$ob&ad=$ad&rp=$i&st=0\">$i</a>";
}else
{
echo "<b>$i</b>";
}
if($i != 100)
{
echo " | ";
}
}

echo "<br />";
}
$buttonbar = "<div id=\"buttonbar\"><div id=\"buttonbarleft\"><input type=\"submit\" class=\"button\" name=\"delete\" value=\"Delete\"> ".$addgroupbutton."</div><div id=\"buttonbarright\">";

$buttonbar .= "Pages: ";

$numpages = ceil($numresults/$rp);
$pagenum = ($st/$rp)+1;

if($pagenum > 4)
{
$numtoremove = $pagenum-4;
}else{
$numtoremove = 0;
}
if($pagenum < 5)
{
$topnum = $pagenum+(8-$pagenum);
}else
{
$topnum = $pagenum+3;
}

if($numpages < 9)
{
$topnum = 8;
$numtoremove = 0;
}

if($numpages > 8 && $pagenum > ($numpages-3))
{
$topnum = $numpages;
$numtoremove = $numpages-7;
}

if($pagenum > 4 && $numpages > 8)
{
$buttonbar .= "<a style=\"text-decoration: none\" href=".$urlstart."&ob=$ob&ad=$ad&rp=$rp&st=0\"><</a> | ";
}

for($i=0;$i<$numpages;$i++)
{

$j = $i*$rp;
$k = $i+1;

if($i >= $numtoremove && $i < $topnum)
{
$j = $i*$rp;
$k = $i+1;
if($st != $j)
{
$buttonbar .= "<a href=".$urlstart."&ob=$ob&ad=$ad&rp=$rp&st=$j\">$k</a>";
}else
{
$buttonbar .= "<b>$k</b>";
}
if($i != ($numpages-1))
{
$buttonbar .= " | ";
}
}
}
if($topnum != $numpages && $numpages > 7)
{
$buttonbar .= "<a style=\"text-decoration: none\" href=".$urlstart."&ob=$ob&ad=$ad&rp=$rp&st=".(($numpages*$rp)-$rp)."\">></a>";
}
$buttonbar .= "</div>";
$buttonbar .= "</div><br />";

echo "<br /><br />";
echo "<form name=\"slform\" action=\"index.php?p=editor\" method=\"post\">\n";
echo "<input type=\"hidden\" name=\"pagetrack\" value=\"delete\">";
echo $buttonbar;
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
echo "<input type=\"hidden\" name=\"t\" value=\"$t\">\n";
while($fu=mysql_fetch_array($findurl))
{
echo "<div id=\"slcontainer\"><div id=\"slidchk\"><input type=\"checkbox\" name=\"durl[]\" value=\"$fu[eid]\"></div><div id=\"slurlinfo\"><a href=\"index.php?p=sitelist&nou=$fu[nou]";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "&".$i."=".$fu["url".$i];
}
$numberurls = $fu[nou] + 1;
echo "&collapse=$fu[collapse]\">$fu[grouptitle]</a>";
if($fu['private'] == "true"){echo " <font class=\"smallred\">(private)</font>";}
if($fu[groupdescription] != ""){ echo "<br />"; }
echo "$fu[groupdescription]<br/><font class=\"smallgrey\">".date("D F j, Y, g:i a",strtotime($fu[tstamp]))." | $numberurls URLs (<a class=\"fl\" onclick=\"toggleshow('sublink$fu[eid]');\">Show/Hide</a>) | <a href=\"index.php?p=editor&gid=$fu[eid]\">Edit</a></font></div></div>\n";
echo "<div class=\"urllist\" id=\"sublink$fu[eid]\"><font class=\"smallfont\">";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "<a href=\"".$fu["url".$i]."\" target=\"_blank\">".$fu["url".$i]."</a><br />";
}
echo "</font></div>";
}
if($numresults >= 11)
{
echo "<br />".$buttonbar;
}
echo "</form>";
}
}
else{
include "pages/signin.php";
}
?>