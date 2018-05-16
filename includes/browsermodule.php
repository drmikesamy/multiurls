<div id="bar">
  <img src="images/arrowleft.png" width="25" height="21" alt="Back" onClick="javascript:document.getElementById('frame<?php echo $browsernum; ?>').history.back(1);">
  <img src="images/arrowright.png" width="25" height="21" alt="Forward" onClick="javascript:document.getElementById('frame<?php echo $browsernum; ?>').history.forward(1);">
  <img src="images/reload.png" width="25" height="21" alt="Refresh" onClick="document.getElementById('frame<?php echo $browsernum; ?>').src=document.getElementById('frame<?php echo $browsernum; ?>').src;">
  <input type="textbox" class="inputbox" name="urlbox<?php echo $browsernum; ?>" id="urlbox<?php echo $browsernum; ?>" size="70" value="<?php if(!ereg("^(http|https|ftp)://(.*)",$_GET[$browsernum])){echo "http://".$_GET[$browsernum];}else{echo $_GET[$browsernum];} ?>" onkeypress="eUpdateURL(event,<?php echo $browsernum; ?>)">
    <img src="images/go.png" width="25" height="21" alt="Load URL" onClick="cUpdateURL(<?php echo $browsernum; ?>)">
    <input type="button" class="barbutton" value="Show/Hide Page" onClick="toggleshow('content<?php echo $browsernum; ?>');">
    <input type="button" class="barbutton" value="Maximise" onClick="javascript:window.open(document.getElementById('urlbox<?php echo $browsernum; ?>').value);">
  </div>
  <div id="content<?php echo $browsernum; ?>" class="content">
    <iframe name="frame<?php echo $browsernum; ?>" id="frame<?php echo $browsernum; ?>" scrolling="no" src="<?php if($browsernum == "0") {if($_GET[$browsernum] == "http://" or $_GET[$browsernum] == ""){echo "pf.php?url=http://localhost/reppex5/nosite.html&urlno=0";}elseif(!ereg("^(http|https|ftp)://(.*)",$_GET[$browsernum])){echo "pf.php?url=http://".$_GET[$browsernum]."&urlno=0";}else{echo "pf.php?url=".$_GET[$browsernum]."&urlno=0";}} ?>" height="100%" width="100%" frameborder="0" scrolling="yes" style="position:relative;border-width: 0px;overflow: hidden;">Your browser does not support iframes. We recommend using Mozilla Firefox or Internet Explorer.</iframe>
    </div>
