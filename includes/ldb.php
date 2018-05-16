<?php
$mc = mysqli_connect($dbh, $dbun, $dbpw, $dbn);

/*check connection*/
if (mysqli_connect_errno()) {
  printf("connection failed: %s\n", mysqli_connect_error());
  exit();
}
?>
