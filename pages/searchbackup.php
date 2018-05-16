<b>Search:</b> <br /><br />
<?php 
if($_SERVER['REQUEST_METHOD'] == "POST")
{
include "../../d/config.php";
include "includes/ldb.php";

if($_POST['searchall'] == "true")
{

}else{

}

include "includes/cdb.php";
}else{
include "includes/searchbox.php"; 
}
?>