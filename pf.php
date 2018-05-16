<html>
<head>
  <style type="text/css">
  body{
    margin-top: 2px;
    margin-left: 2px;
    margin-right: 2px;
    margin-bottom: 2px;
  }
</style>
</head>
<body onload="window.parent.sl('<?php echo $_GET['urlno']; ?>');">
  <iframe name="site1" width="100%" frameborder="0" height="100%" src="<?php echo $_GET['url']; ?>"></iframe>
</body>
</html>
