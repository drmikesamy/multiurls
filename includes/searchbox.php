<form name="search1" method="GET">
<input type="hidden" name="p" value="search">
Search terms:<br /><input type="text" name="q" value="<?php echo $_GET['q']; ?>" size="70"><br /><br />
Search by user name:<br /><input type="text" name="u" value="<?php echo $_GET['u']; ?>" size="70"><br /><br />
<input type="submit" name="an" value="Search All" class="button">
</form>
<input type="button" value="Search My Saved Sites" onclick="document.search1.u.value = '<?php echo $_SESSION['username']; ?>';document.search1.submit();" class="button">