<b>Sign in</b><br /><br />
<?php
echo "<font class=\"error\">";
if($_GET['upe'] == "true")
{
  echo "The username and/or password you specified are incorrect.<br /><br />";
}
if($_GET['se'] == "true")
{
  echo "There was an error with the signin form. Please sign in again.<br /><br />";
}
echo "</font>";
$t = md5(uniqid(rand()));
$_SESSION['ttstamp'] = time();
?>
<form name="signinform" method="post" action="signin.php">
  <input type="hidden" name="t" value="<?php echo $t; ?>">
  <?php $_SESSION['ts'] = $t; ?>
  <div id="signleft">
    <div id="lc">Username:</div>
    <div id="lc">Password:</div>
    <div id="cblc"><input type="checkbox" name="remember"></div>
  </div>
  <div id="signright">
    <div id="rc"><input type="text" name="uname" value=""></div>
    <div id="rc"><input type="password" name="pword" value=""></div>
    <div id="rc">Remember me</div>
    <div id="rc"><input type="submit" name="submit" value="Sign in"></div>
  </div>
</form>
<br /><br />
<center><b>Don't have an account? <a href="index.php?p=register">Click here</a> to make one.</b></center>
