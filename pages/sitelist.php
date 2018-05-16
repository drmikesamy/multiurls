<script language="JavaScript">
var initlo = 0;
function sl(urlno)
{
  ct = 0;
  turlno = urlno;
  lt = setInterval("corc()",50);
}
function corc()
{
  if(ct == "1")
  {
    clearInterval(lt);
  }else{
    var navi = navigator.appName;
    if(navi == "Netscape")
    {
      window.stop();
    }else{
      document.execCommand('Stop');
    }
    if(initlo != 1)
    {
      document.getElementById("uln"+turlno).innerHTML = "Done";
    }
    if(turlno == "<?php echo $_GET['nou']; ?>")
    {
      <?php if($_GET['collapse'] == "false"){echo "showall();";} ?>
      hide('pl');
      initlo = 1;
    }
    <?php
    for($i=0;$i<$_GET['nou'];$i++)
    {
      echo "if(turlno == \"$i\"){f".$i."l();}\n";
    }
    ?>
    document
    ct++;
  }
}
<?php
for($i=0;$i<$_GET['nou'];$i++)
{
  $j = $i+1;
  $fullurl = $_GET['url'+$j];
  if($fullurl == "http://" or $fullurl == ""){$fullurl = "pf.php?url=http://localhost/reppex5/nosite.html&urlno=".$j;}elseif(!ereg("^(http|https|ftp)://(.*)",$fullurl)){$fullurl = "pf.php?url=http://".$fullurl."&urlno=".$j;}else{$fullurl = "pf.php?url=".$fullurl."&urlno=".$j;}
    echo "function f".$i."l(){frames['frame".$j."'].location.href = \"".$fullurl."\";}\n";
  }
  ?>
  function f<?php echo $_GET['nou']; ?>l(){}
</script>
<?php
$slt = md5(uniqid(rand()));
$_SESSION['slts'] = $slt;
$_SESSION['slttstamp'] = time();
?>
<script language="JavaScript">
function showall(){for(x=0;x<=<?php echo $_GET['nou']; ?>;x++){show("content"+x);}}
function hideall(){for(x=0;x<=<?php echo $_GET['nou']; ?>;x++){hide("content"+x);}}
function rlall(){document.getElementById('frame0').src="pf.php?url="+document.getElementById('urlbox0').value+"&urlno=0";}
function saveURLs()
{
  for(x=0;x<=<?php echo $_GET['nou']; ?>;x++)
  {
    var boxurl = document.getElementById('urlbox'+x).value;
    if(boxurl.match(/(http|https|ftp):.*/))
    {
      document.getElementById('durl'+x).value = document.getElementById('urlbox'+x).value;
    }else{
      document.getElementById('durl'+x).value = "http://"+document.getElementById('urlbox'+x).value;
    }
  }
  document.saveForm.submit();
}
function eUpdateURL(event,bnum)
{
  var whichk = event.keyCode || event.which;
  if(whichk == 13)
  {
    cUpdateURL(bnum);
  }
}
function cUpdateURL(bnum)
{
  var boxurl = document.getElementById('urlbox'+bnum).value;
  if(boxurl.match(/(http|https|ftp):.*/))
  {
    document.getElementById('frame'+bnum).src="pf.php?url="+document.getElementById('urlbox'+bnum).value;
  }else{
    document.getElementById('urlbox'+bnum).value="http://"+document.getElementById('urlbox'+bnum).value;
    document.getElementById('frame'+bnum).src="pf.php?url="+document.getElementById('urlbox'+bnum).value;
  }
}
</script>
<div id="pl">
  <font class="greyhead">
    Please wait while MultiURLs loads your sites...<br /><br />
  </font>
  <a href="#" onclick="javascript:window.stop()">Click here to skip the current site</a><br /><br />
  <font class="plsmallfonts">
    <?php
    for($i=0;$i<$_GET['nou']+1;$i++)
    {
      echo "<div id=\"containerpl\"><div id=\"leftpl\">".$_GET[$i]."</div><div id=\"rightpl\"><div id=\"uln".$i."\">Loading...</div></div></div>";
    }
    ?>
  </font>
</div>

<div id="left">
  <div id="nav">
    <a href="#" onclick="javascript:saveURLs();">Save</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" onclick="javascript:rlall();">Reload All</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" onclick="javascript:showall();">Show All</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" onclick="javascript:hideall();">Hide All</a>

  </div>
  <div id="paddedtrans">
    Your Site List (<?php echo $_GET['nou']+1; ?> Sites):
  </div>
  <?php
  for($i=0;$i<15;$i++)
  {
    $browsernum = $i;
    if($_GET['nou'] < $browsernum)
    {echo "";}else{
      include 'includes/browsermodule.php';
    }
  }
  ?>
  <form name="saveForm" method="post" action="index.php?p=save">
    <input type="hidden" name="nou" value="<?php echo $_GET['nou']; ?>">
    <input type="hidden" name="sh" value="<?php echo $slt; ?>">
    <input type="hidden" name="tss" value="<?php echo $_SESSION['slttstamp']; ?>">
    <?php
    for($i=0;$i<$_GET['nou']+1;$i++)
    {
      echo "<input type=\"hidden\" id=\"durl".$i."\" name=\"urlbox".$i."\" value=\"".$_GET[$i]."\">\n";
    }
    ?>
    <input type="hidden" name="collapse" value="<?php echo $_GET['collapse']; ?>">
  </form>
</div>
