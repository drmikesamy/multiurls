<form name="regform" method="post" action="index.php?p=register">
  <input type="hidden" name="t" value="<?php echo $t; ?>">
  <div id="regleft">
    <div id="lc">Username:</div>
    <div id="lc">Password:</div>
    <div id="lc">Password (repeat):</div>
    <div id="lc">Email address:</div>
    <div id="lc"></div>
  </div>
  <div id="regright">
    <div id="rc"><input type="text" name="uname" value="<?php echo $_POST['uname']; ?>"></div>
    <div id="rc"><input type="password" name="pword" value=""></div>
    <div id="rc"><input type="password" name="pword2" value=""></div>
    <div id="rc"><input type="text" name="email" value="<?php echo $_POST['email']; ?>"></div>
    <div id="rc"><input type="submit" value="Register"></div>
  </div>
</form>
