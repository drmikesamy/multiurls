<?php
if($_POST['pagetrack'] == "delete")
{

if($_SESSION['username'] != "" && $_POST['durl'] != "" && $_POST['t'] == $_SESSION['ts'] && $_SESSION['ttstamp'] > (time() - 360))
{
include "d48378/config.php";
include "includes/ldb.php";
$uname = $_SESSION['username'];
while(list($i,$j) = each($_POST['durl']))
{
$msql = "DELETE FROM user_URLs WHERE eid=$j AND uname='$uname'";
mysql_query($msql,$mc);
}
include "includes/cdb.php";
echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?p=savedsites\">";
}
elseif($_SESSION['username'] != "" && $_POST['durl'] == "" && $_POST['t'] == $_SESSION['ts'] && $_SESSION['ttstamp'] > (time() - 360))
{
echo "<font color=\"#333333\">You didn't select anything to delete!</font><br /><br />";
echo "<meta http-equiv=\"refresh\" content=\"2;url=index.php?p=savedsites\"><font class=\"smallgrey\">(If you aren't automatically redirected, <a href=\"index.php?p=savedsites\">click here</a> to return).</font>";
}
else{
echo "";
}

}elseif($_POST['pagetrack'] == "editor"){

include "d48378/config.php";
include "includes/ldb.php";
$sessuname = $_SESSION['username'];
$postid = cleanvars($_POST['gid']);
$checkpsql = mysql_query("SELECT * FROM user_URLs WHERE uname = '$sessuname' AND eid = '$postid'");
$dbce = mysql_fetch_array($checkpsql);
$dbcheckedeid = $dbce['eid'];
if($_SESSION['username'] != "" && $postid == $dbcheckedeid && $_SERVER['REQUEST_METHOD'] == "POST" && $_POST['t'] == $_SESSION['ts'] && $_SESSION['ttstamp'] > (time() - 360))
{
for($i=0;$i<15;$i++)
{
if(!ereg("^(http|https|ftp)://(.*)",$_POST[$i]))
{
$_POST[$i] = "http://".$_POST[$i];
}
}

$cl = array();
switch($_POST['private'])
{
case 'true';
case 'false';
$cl['private'] = $_POST['private'];
break;
}
$_POST['private'] = $cl['private'];
$cl = array();
switch($_POST['collapse'])
{
case 'true';
case 'false';
$cl['collapse'] = $_POST['collapse'];
break;
}
$_POST['collapse'] = $cl['collapse'];

$msql = "UPDATE user_URLs SET grouptitle='".cleanvars($_POST['grouptitle'])."', nou='".cleanvars($_POST['nou'])."', url0='".cleanvars($_POST[0])."',url1='".cleanvars($_POST[1])."',url2='".cleanvars($_POST[2])."',url3='".cleanvars($_POST[3])."',url4='".cleanvars($_POST[4])."',url5='".cleanvars($_POST[5])."',url6='".cleanvars($_POST[6])."',url7='".cleanvars($_POST[7])."',url8='".cleanvars($_POST[8])."',url9='".cleanvars($_POST[9])."',url10='".cleanvars($_POST[10])."',url11='".cleanvars($_POST[11])."',url12='".cleanvars($_POST[12])."',url13='".cleanvars($_POST[13])."',url14='".cleanvars($_POST[14])."',collapse='".cleanvars($_POST['collapse'])."',private='".cleanvars($_POST['private'])."' WHERE eid='".cleanvars($_POST['gid'])."' AND uname='$sessuname'";
mysql_query($msql,$mc);
}
include "includes/cdb.php";
echo "If you are not automatically redirected, <a href=\"index.php?p=savedsites\">click here</a> to go back.<script language=\"JavaScript\">document.location.href=\"index.php?p=savedsites\";</script>";
}else{
if($_SESSION['username'] != "")
{
include "d48378/config.php";
include "includes/ldb.php";
$sessuname = $_SESSION['username'];
$getid = cleanvars($_GET['gid']);
$findurls = mysql_query("SELECT * FROM user_URLs WHERE uname = '$sessuname' AND eid = '$getid'");
$urlsr = mysql_fetch_array($findurls);
$t = md5(uniqid(rand()));
$_SESSION['ts'] = $t;
$_SESSION['ttstamp'] = time();
?>
<script language="javascript">
function swap(firsturl,secondurl)
{
firsturlmem = document.getElementById("urlbox"+firsturl).value;
document.getElementById("urlbox"+firsturl).value = document.getElementById("urlbox"+secondurl).value;
document.getElementById("urlbox"+secondurl).value = firsturlmem;
}
function setnou()
{
document.form1.nou.value = "<?php echo $urlsr['nou']; ?>";
}
</script>
<form name="form1" method="post" action="index.php?p=editor">
<input type="hidden" name="pagetrack" value="editor">
<b>Editor:</b> Editing Group: <input type="text" size="55" name="grouptitle" class="bluebgtextbox" value="<?php echo $urlsr['grouptitle']; ?>"><br /><br />
<input name="nou" type="hidden" value="<?php echo $urlsr['nou']; ?>">
<input name="gid" type="hidden" value="<?php echo cleanvars($_GET['gid']); ?>">
<input name="t" type="hidden" value="<?php echo $t; ?>">
<?php 
for($j=0;$j<15;$j++)
{
$textboxcode[$j] = "<input type=\"text\" id=\"urlbox$j\" class=\"hometextshow\" name=\"$j\" value=\"";
if($j >= $urlsr['nou']+1){$textboxcode[$j] .= "http://";}else{$textboxcode[$j] .= $urlsr['url'.$j];}
$textboxcode[$j] .= "\" size=\"78\"><div class=\"movearrow\"><img src=\"images/uparrow.png\" onclick=\"swap($j,".($j-1).")\"><img src=\"images/downarrow.png\" onclick=\"swap($j,".($j+1).")\"></div>";
}
for($j=0;$j<$urlsr['nou']+1;$j++)
{
echo "<div id=\"$j\">".$textboxcode[$j]."</div>\n";
} 
for($j=$urlsr['nou']+1;$j<15;$j++)
{
echo "<div id=\"$j\" class=\"editorhiddendiv\">".$textboxcode[$j]."</div>\n";
} 
?>
<br />
<input type="button" value="Add More Sites" onclick="addSite()" > <input type="button" value="Remove Last Site" onclick="removeSite()"><br /><br />
<input type=radio name=collapse value="false" <?php if($urlsr['collapse'] == "false"){echo "checked";} ?>> All Sites Expanded <input type=radio name=collapse value="true" <?php if($urlsr['collapse'] == "true"){echo "checked";} ?>> All Sites Collapsed<br /><br />
<input type=radio name=private value="false" <?php if($urlsr['private'] == "false"){echo "checked";} ?>> Public <input type=radio name=private value="true" <?php if($urlsr['private'] == "true"){echo "checked";} ?>> Private<br /><br />
<input type="submit" value="Save Changes"> <input type="button" value="Cancel" onclick="javascript:top.location.href='index.php?p=savedsites';">
</form>
<?php include "includes/cdb.php";}
else{
echo "You are not signed in!";
}
}
?>