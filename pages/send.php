<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $inserturl = "INSERT INTO sharing (userto, userfrom, subject, comments, nou, url0, url1, url2, url3, url4, url5, url6, url7, url8, url9, url10, url11, url12, url13, url14, collapse, private, tstamp) VALUES ('$_POST[userto]', '$_SESSION[username]', '$_POST[subject]', '$_POST[message]', '$_SESSION[senou]', '$_SESSION[url0]', '$_SESSION[url1]', '$_SESSION[url2]', '$_SESSION[url3]', '$_SESSION[url4]', '$_SESSION[url5]', '$_SESSION[url6]', '$_SESSION[url7]', '$_SESSION[url8]', '$_SESSION[url9]', '$_SESSION[url10]', '$_SESSION[url11]', '$_SESSION[url12]', '$_SESSION[url13]', '$_SESSION[url14]', '$_SESSION[secollapse]', '$isprivate', '$cdt')";
  mysql_query($inserturl, $mc);
  include "includes/cdb.php";
  echo "Message Sent";
}
else{
  include "includes/messageform.php";
}
?>
