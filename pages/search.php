<b>Search:</b> <br /><br />

<?php
if(($_GET['u'] != "" || $_GET['q'] != "") OR ($_GET['u'] != "" && $_GET['q'] != ""))
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
$searchterm = cleanvars($_GET['q']);
$searchun = cleanvars($_GET['u']);



$msql = "SELECT * FROM user_URLs WHERE ";

if($un && $searchun == $un)
{
$msql .= "uname = '$un'";
}
elseif($searchun)
{
$msql .= "uname = '$searchun'";
}
else
{
$firstpart = "false";
}

if($firstpart == "false"){
}elseif((($un && $un != $searchun) || (!$un) || (!$searchun))){
$msql .= " AND ";
}

if(($un && $un != $searchun) || (!$un) || (!$searchun))
{
$msql .= "private = 'false'";
}

if($searchterm)
{
$msql .= " AND MATCH(grouptitle,groupdescription) AGAINST ('$searchterm' IN BOOLEAN MODE)";
}



$numresults = mysql_num_rows(mysql_query($msql));
$msql .= " ORDER BY ";
if($ob != "")
{
$msql .= "$ob";
}else{
$msql .= "tstamp";
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

$urlstart = "\"index.php?p=search&q=".htmlspecialchars($searchterm)."&u=".htmlspecialchars($searchun);

if($numresults == "0")
{
echo "<font color=\"#333333\">Sorry, I can't anything matching your request!</font><br />";
}
else
{
echo "Order by ";

echo "<a href=".$urlstart."&ob=grouptitle&ad=";
if($ob == "grouptitle" && $ad != "desc"){echo "desc";}else{echo "asc";}
echo "&st=$st&rp=$rp\">Title</a> | ";

echo "<a href=".$urlstart."&ob=tstamp&ad=";
if($ob == "tstamp" && $ad != "asc"){echo "asc";}else{echo "desc";}
echo "&st=$st&rp=$rp\">Date added</a> | ";

echo "<a href=".$urlstart."&ob=nou&ad=";
if($ob == "nou" && $ad != "asc"){echo "asc";}else{echo "desc";}
echo "&st=$st&rp=$rp\">Number of URLs</a>";

echo "<br /><br />";

if($numresults >= 11)
{

echo "Number of results per page ";
foreach(array(10,25,50,100) as $i)
{
if($rp != $i)
{
echo "<a href=".$urlstart."&ob=$ob&ad=$ad&rp=$i&st=0\">$i</a>";
}else
{
echo "<b>$i</b>";
}
if($i != 100)
{
echo " | ";
}
if($i == 100)
{
echo "<br />";
}
}

echo "<br />";
}

$numpages = ceil($numresults/$rp);
$pagenum = ($st/$rp)+1;

$buttonbar = "<div id=\"buttonbars\"><div id=\"buttonbarsleft\">Found <b>".$numresults."</b> matches</div><div id=\"buttonbarsright\">";

$buttonbar .= "Pages: ";

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


echo $buttonbar;

while($fu=mysql_fetch_array($findurl))
{
echo "<div id=\"slcontainer\"><div id=\"slurlinfo\"><a href=\"index.php?p=sitelist&nou=$fu[nou]";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "&".$i."=".$fu["url".$i];
}
$numberurls = $fu[nou] + 1;
echo "&collapse=$fu[collapse]\">$fu[grouptitle]</a>";
if($fu['private'] == "true"){echo " <font class=\"smallred\">(private)</font>";}
if($fu[groupdescription] != ""){ echo "<br />"; }
echo "$fu[groupdescription]<br/><font class=\"smallgrey\">".date("D F j, Y, g:i a",strtotime($fu[tstamp]))." | $numberurls URLs (<a class=\"fl\" onclick=\"toggleshow('sublink$fu[eid]');\">Show/Hide</a>) | Posted by <a href=index.php?p=search&u=$fu[uname]>$fu[uname]</a></font></div></div>\n";
echo "<div class=\"urllist\" id=\"sublink$fu[eid]\"><font class=\"smallfont\">";
for($i=0;$i<$fu[nou]+1;$i++)
{
echo "<a href=\"".$fu["url".$i]."\" target=\"_blank\">".$fu["url".$i]."</a><br />";
}
echo "</font></div><br />";
}
}
if($numresults >= 11)
{
echo $buttonbar;
}
echo "<br /><br /><b>Search Again:</b><br /><br />";
include "includes/searchbox.php";
}
elseif($_GET['u'] == "" && $_GET['q'] == "" && $_GET['an'] == "Search+All"){
echo "<font color=\"#333333\">Please enter a search term!</font><br /><br />";
include "includes/searchbox.php";
}
else
{
include "includes/searchbox.php";
}
?>
