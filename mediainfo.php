<?php
include('rl_init.php');
login_check();

$page_title = 'Media Info Generator';
include(TEMPLATE_DIR.'header.php');
?>
<center><h2>Media Info Generator</h2>
<form method="post">
<table align="center" border="0" cellspacing="2">
  <tr>
    <td align="center"><b>Video File :</b> </td><td><select name="video">
<?php

$exts=array(".3gp", ".3g2", ".asf", ".avi", ".dat", ".divx", ".dsm", ".evo", ".flv", ".m1v", ".m2ts", ".m2v", ".m4a", ".mj2", ".mjpg", ".mjpeg", ".mkv", ".mov", ".moov", ".mp4", ".mpg", ".mpeg", ".mpv", ".nut", ".ogg", ".ogm", ".qt", ".swf", ".ts", ".vob", ".wmv", ".xvid");
function vidlist() 
{
        $results = array();
        $handler = opendir(DOWNLOAD_DIRr);
        while ($file = readdir($handler)) 
        {
				if ($file == '.' || $file == '..' || strpos($file, '.') === false || substr($file, 0, 1) == '.') continue;
				$ext = strtolower(substr($file, strrpos($file, '.')));
				if (!empty($ext) && in_array($ext, $GLOBALS["exts"]) && strpos($file, '?') === false) $results[] = $file;
        }
closedir($handler);
sort($results);
return $results;
}
$files = vidlist();
foreach($files as $file)
{
        echo '<option value="'.$file.'">'.$file.'</option>';
} 
?></td><td>
<input type="submit" name="submit" />
</td></tr>
<tr>
<td align="right"></td><td align="center"> Save to Textfile:<input type="checkbox" name="output_text" value="yes">
</td></tr>

</table>
</form>


<?php
if (isset($_POST["submit"]))
{
$vid = DOWNLOAD_DIR . basename($_POST["video"]);
$output = shell_exec('mediainfo ' . escapeshellarg($vid));
echo '<textarea rows="40" cols="120" >'.$output.'</textarea>';
if (($_POST["output_text"]) == "yes")
{
$txtout = $vid.".txt";
file_put_contents($txtout, $output);
} 
} 
?> 