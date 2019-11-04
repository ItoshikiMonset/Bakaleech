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
MP4,FLV,MP3,OGG.. URL: </span> <input type="text" name="url">
<input type="submit" value="Play">
</form>
';
}

if (isset($_POST['url'])){
   $url2 = $_POST['url'];
   $url3 = htmlspecialchars("$url2", ENT_QUOTES);

echo '
<center>
<br /><br />
<object id="player1" width="480" height="270" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
        <param name="flashvars" value="file=' . $url3 . '&amp;autostart=true" />
        <param name="allowfullscreen" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="src" value="player.swf" />
        <embed id="player1" width="480" height="270" type="application/x-shockwave-flash" src="player.swf" flashvars="file=' . $url3 . '&amp;autostart=true" allowfullscreen="true" allowscriptaccess="always" />
</object>
</center>
</body>
';

}

?>
