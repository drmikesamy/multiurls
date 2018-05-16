<b>Save:</b><br /><br />Please enter a title and short description for your Site Group:<br /><br /><br />
<div style="width: 100%;text-align: center;">
  <div style="width: 270px;text-align: left; margin-left: auto;margin-right: auto;">
    <form name="addsitelist" method="post" action="index.php?p=save">
      <input type="hidden" name="t" value="<?php echo $t; ?>">
      <input type="hidden" name="refpage" value="addsitelist">
      Site Group Title:<br /><input type="text" name="sgtitle" value="" size="39"><br /><br />
      Short Description:<br /><textarea name="sgdescription" rows="3" cols="30"></textarea><br /><br />
      <input type=radio name=private value="false" checked> Public <input type=radio name=private value="true"> Private<br /><br />
      <input type="submit" name="submit" value="Add Site Group" class="button">
    </form>
  </div>
</div>
