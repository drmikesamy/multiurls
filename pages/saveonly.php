<?php
if($_SESSION['username'])
{
  $slt = md5(uniqid(rand()));
  $_SESSION['slts'] = $slt;
  $_SESSION['slttstamp'] = time();
  $_SESSION['lastviewed'] = "index.php?p=sitelist&nou=".$_GET['nou']."&0=".$_GET['0']."&1=".$_GET['1']."&2=".$_GET['2']."&3=".$_GET['3']."&4=".$_GET['4']."&5=".$_GET['5']."&6=".$_GET['6']."&7=".$_GET['7']."&8=".$_GET['8']."&9=".$_GET['9']."&10=".$_GET['10']."&11=".$_GET['11']."&12=".$_GET['12']."&13=".$_GET['130']."&14=".$_GET['14']."&collapse=".$_GET['collapse'];
  $_SESSION['r_p'] = cleanvars($_GET['p']);
}else{
  echo "<!--";
}
?>
<script language="JavaScript">
function moveToForm()
{
  for(x=0;x<=<?php echo $_GET['nou']; ?>;x++)
  {
    var boxurl = document.getElementById('urlbox'+x).value;
    if(boxurl.match(/(http|https|ftp):.*/))
    {}else{
      document.getElementById('urlbox'+x).value = "http://"+document.getElementById('urlbox'+x).value;
    }
  }
  document.saveForm.submit();
}
</script>
Loading...
<form name="saveForm" method="post" action="index.php?p=save&<?php echo "sh=".$_SESSION['slts']."&tss=".$_SESSION['slttstamp']; ?>">
  <?php
  if($_SESSION['username'])
  {
    echo "<input type=\"hidden\" name=\"nou\" value=\"".$_GET['nou']."\">\n";
    echo "<input type=\"hidden\" name=\"refpage\" value=\"start\">\n";
    for($i=0;$i<15;$i++)
    {
      echo "<input type=\"hidden\" id=\"urlbox".$i."\" name=\"urlbox".$i."\" value=\"".$_GET[$i]."\">\n";
    }
    echo "<input type=\"hidden\" name=\"collapse\" value=\"".$_GET['collapse']."\">\n";
  }
  ?>
</form>
<?php
if(!$_SESSION['username'])
{
  echo "-->";
}
?>
