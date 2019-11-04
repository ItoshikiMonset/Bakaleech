<html>
<head>
<title>Player</title>
<style type="text/css">
body {background-color: black;color: white;font-size:1.2em;}
a:link {color:#FFFFFF;}    /* unvisited link */
a:visited {color:#FFFFFF;} /* visited link */
a:hover {color:#FFFFFF;}   /* mouse over link */
a:active {color:#FFFFFF;}  /* selected link */
</style>
</head>
<body>

<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

if (!isset($_POST['url'])){
echo '
<form name="input" action="" method="post" target="bottom">
AVI/MKV URL: </span> <input type="text" name="url">
<input type="submit" value="Play">
</form>
';
}

if (isset($_POST['url'])){
   $url2 = $_POST['url'];
   $url3 = htmlspecialchars("$url2", ENT_QUOTES);

echo '
<center>

<object classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" width="640" height="500" codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab">
 <param name="custommode" value="none" />
  <param name="loop" value="true" />
  <param name="src" value="' . $url3 . '" />
<embed type="video/divx" src="' . $url3 . '" custommode="none" width="640" height="500" loop="true"  pluginspage="http://go.divx.com/plugin/download/">
</embed>

</object>
</center>
</body>
</html>';

}

?>
