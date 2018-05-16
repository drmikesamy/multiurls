<script language="JavaScript">
function viewSites()
{
  document.form1.action = 'index.php';
}
function saveOnly()
{
  document.form1.p.value = "saveonly";
  document.form1.action = 'index.php';
}
</script>
<b>Enter some of your favourite sites to begin:</b> <br /><br />
<form name="form1" method="get">
  <input type="hidden" name="p" value="sitelist">
  <input type="hidden" name="refpage" value="start">
  <input name="nou" type="hidden">
  <input type="text" class="hometext" name="0" id="0" value="http://" size="78">
  <input type="text" class="hometext" name="1" id="1" value="http://" size="78">
  <input type="text" class="hometext" name="2" id="2" value="http://" size="78">
  <input type="text" class="hometext" name="3" id="3" value="http://" size="78">
  <input type="text" class="hometext" name="4" id="4" value="http://" size="78">
  <input type="text" class="hometext" name="5" id="5" value="http://" size="78">
  <input type="text" class="hometext" name="6" id="6" value="http://" size="78">
  <input type="text" class="hometext" name="7" id="7" value="http://" size="78">
  <input type="text" class="hometext" name="8" id="8" value="http://" size="78">
  <input type="text" class="hometext" name="9" id="9" value="http://" size="78">
  <input type="text" class="hometext" name="10" id="10" value="http://" size="78">
  <input type="text" class="hometext" name="11" id="11" value="http://" size="78">
  <input type="text" class="hometext" name="12" id="12" value="http://" size="78">
  <input type="text" class="hometext" name="13" id="13" value="http://" size="78">
  <input type="text" class="hometext" name="14" id="14" value="http://" size="78"><br />
  <input type="button" value="Add More Sites" onclick="addSite()" class="button"> <input type="button" value="Remove Last Site" onclick="removeSite()" class="button"><br /><br />
  <input type=radio name=collapse value="false" checked> All Sites Expanded <input type=radio name=collapse value="true"> All Sites Collapsed<br /><br />
  <input type="submit" value="View these sites" onclick="viewSites();" class="button">
  <?php if($_SESSION['username'] != ""){echo "<input type=\"submit\" value=\"Save only\" onclick=\"saveOnly();\" class=\"button\">";} ?>
</form>
