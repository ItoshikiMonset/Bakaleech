<?php
define('RAPIDLEECH', 'yes');
error_reporting(0);
set_time_limit(0);
session_start();
define('CONFIG_DIR', 'configs/');
require_once(CONFIG_DIR.'setup.php');
define ( 'TEMPLATE_DIR', 'templates/'.$options['template_used'].'/' );
define ('CREDITS', '<small class="small-credits">By jmsmarcelo</small><br />');
// Include other useful functions
require_once('classes/other.php');
login_check();
include(TEMPLATE_DIR.'header.php');
?>
<title>Movie Thumbnailer</title>
 <!-- Begin BidVertiser code -->

<!-- End BidVertiser code -->
<center><h2>Movie Thumbnailer</h2>
<form method="post">
<table align="center" border="0" cellspacing="2">
  <tr>
    <td align="right">Video File <span class="nav_text" onMouseOver="document.getElementById('help_text').style.display='block'" onMouseOut="document.getElementById('help_text').style.display='none'" style="cursor:help"> [*]</span> : </td><td><select name="video">
<?php
$exts=array(".3gp", ".3g2", ".asf", ".avi", ".dat", ".divx", ".dsm", ".evo", ".flv", ".m1v", ".m2ts", ".m2v", ".m4a", ".mj2", ".mjpg", ".mjpeg", ".mkv", ".mov", ".moov", ".mp4", ".mpg", ".mpeg", ".mpv", ".nut", ".ogg", ".ogm", ".qt", ".swf", ".ts", ".vob", ".wmv", ".xvid");
$ext="";
function vidlist($dir) 
{
        $results = array();
        $handler = opendir($dir);
        while ($file = readdir($handler)) 
        {
                if (strrchr($file,'.')!="")
                {
                        $ext=strtolower(strrchr($file,'.'));
                }
                if ($file != '.' && $file != '..' && in_array($ext,$GLOBALS["exts"]))
                {
                                $results[] = $file;
                }
        }
closedir($handler);
sort($results);
return $results;
}
$files = vidlist($options['download_dir']);
foreach($files as $file)
{
        echo '<option value="'.$file.'">'.$file.'</option>';
}
?>

</td>
  </tr>
  <tr>
    <td align="right">Columns : </td><td><select name=cs><option value= > 1 </option>
                                                         <option value=2> 2 </option>
                                                         <option value=3> 3 </option>
                                                         <option value=4 selected> 4 </option>
                                                         <option value=5> 5 </option></select> x <select name=rs><option value= > 1 </option>
                                                                                                                <option value=2> 2 </option>
                                                                                                                <option value=3> 3 </option>
                                                                                                                <option value=4> 4 </option>
                                                                                                                <option value=5 selected> 5 </option>
                                                                                                                <option value=6> 6 </option>
                                                                                                                <option value=7> 7 </option>
                                                                                                                <option value=8> 8 </option>
                                                                                                                <option value=9> 9 </option>
                                                                                                                <option value=10> 10 </option></select> Rows</td>
  </tr>
  <tr>
    <td align="right">Width <span class="nav_text" onMouseOver="document.getElementById('help_text2').style.display='block'" onMouseOut="document.getElementById('help_text2').style.display='none'" style="cursor:help"> [*]</span> : </td><td><input type=text name=w size=3 ></td>
  </tr>
  <tr>
    <td align="right">Minimum Height <span class="nav_text" onMouseOver="document.getElementById('help_text3').style.display='block'" onMouseOut="document.getElementById('help_text3').style.display='none'" style="cursor:help"> [*]</span> : </td><td><input type=text name=h size=3 value=100></td>
  </tr>
  <tr>
    <td align="right">Text <span class="nav_text" onMouseOver="document.getElementById('help_text4').style.display='block'" onMouseOut="document.getElementById('help_text4').style.display='none'" style="cursor:help"> [?]</span> : </td><td><input type=text name=T size=15 value='- BPItoshiki -'></td>
  </tr>
  <tr>
    <td align="right">Background Color : </td><td><select name=k><option value=000000> Black </option>
                                                                 <option value=000099> Blue </option>
                                                                 <option value=006600> Green </option>
                                                                 <option value=CC0000> Red </option>
                                                                 <option value=FFFF00> Yellow </option>
                                                                 <option value=FFFFFF> White </option></select></td>
  </tr>
  <tr>
    <td align="right">Jpeg Quality : </td><td><select name=j><option value=80> Low </option>
                                                             <option value=90 selected> Normal </option>
                                                             <option value=100> Right </option></select></td>
  </tr>
  <tr>
    <td align="right">Edge <span class="nav_text" onMouseOver="document.getElementById('help_text5').style.display='block'" onMouseOut="document.getElementById('help_text5').style.display='none'" style="cursor:help"> [?]</span> : </td><td><select name=g><option value=0> Off </option>
                                                                                                                                                                                                                                                     <option value=1 selected> 1 </option>
                                                                                                                                                                                                                                                              <option value=2> 2 </option>
                                                                                                                                                                                                                                                              <option value=3> 3 </option>
                                                                                                                                                                                                                                                              <option value=4> 4 </option>
                                                                                                                                                                                                                                                              <option value=5> 5 </option></select></td>
  </tr>
  <tr>
    <td align="right">Individual Shots <span class="nav_text" onMouseOver="document.getElementById('help_text6').style.display='block'" onMouseOut="document.getElementById('help_text6').style.display='none'" style="cursor:help"> [?]</span> : </td><td><input type="checkbox" name="I" value=-I />On</td>
  </tr>
  <tr>
    <td align="right">Video Info : </td><td><input type="checkbox" name="i" value="true" checked/>On &nbsp; <select name=Ts><option value=8> 8 </option>
                                                                                                                            <option value=9> 9 </option>
                                                                                                                            <option value=10 selected> 10 </option>
                                                                                                                            <option value=11> 11 </option>
                                                                                                                            <option value=12> 12 </option>
                                                                                                                            <option value=13> 13 </option>
                                                                                                                            <option value=14> 14 </option>
                                                                                                                            <option value=15> 15 </option></select> Size &nbsp; <select name=Tc><option value=000000> Black </option>
                                                                                                                                                                                              <option value=000099> Blue </option>
                                                                                                                                                                                              <option value=006600> Green </option>
                                                                                                                                                                                              <option value=CC0000> Red </option>
                                                                                                                                                                                              <option value=FFFF00 selected> Yellow </option>
                                                                                                                                                                                              <option value=FFFFFF> White </option></select> Color &nbsp; <select name=f><option value=blue.ttf> Blue </option>
                                                                                                                                                                                                                                                                       <option value=georgia.ttf> Georgia </option>
                                                                                                                                                                                                                                                                       <option value=lsansuni.ttf> Lsansuni </option>
                                                                                                                                                                                                                                                                       <option value=pala.ttf> Pala </option>
                                                                                                                                                                                                                                                                       <option value=palab.ttf> Palab </option>
                                                                                                                                                                                                                                                                       <option value=palabi.ttf> Palabi </option>
                                                                                                                                                                                                                                                                       <option value=palai.ttf> Palai </option>
                                                                                                                                                                                                                                                                       <option value=tahomabd.ttf selected> Tahomabd </option>
                                                                                                                                                                                                                                                                       <option value=xsuni.ttf> Xsuni </option></select> Font</td>
  </tr>
  <tr>
    <td align="right">Time : </td><td><input type="checkbox" name="t" value=true checked/>On &nbsp; <select name=tc><option value=000000> Black </option>
                                                                                                                    <option value=000099> Blue </option>
                                                                                                                    <option value=006600> Green </option>
                                                                                                                    <option value=CC0000 > Red </option>
                                                                                                                    <option value=FFFF00 selected> Yellow </option>
                                                                                                                    <option value=FFFFFF> White </option></select> Color &nbsp; <select name=ts><option value=000000> Black </option>
                                                                                                                                                                                              <option value=000099> Blue </option>
                                                                                                                                                                                              <option value=006600> Green </option>
                                                                                                                                                                                              <option value=CC0000 > Red </option>
                                                                                                                                                                                              <option value=FFFF00> Yellow </option>
                                                                                                                                                                                              <option value=FFFFFF> White </option></select> Shadow</td>
  </tr>
  <tr>
    <td align="right">Location : </td><td><select name=iL><option value=1> Lower Left </option>
                                                          <option value=4 selected> Upper Left </option></select> Info &nbsp; <select name=tL><option value=1> Lower Left </option>
                                                                                                                                              <option value=2 selected> Lower Right </option>
                                                                                                                                              <option value=3> Upper Right </option>
                                                                                                                                              <option value=4> Upper Left </option></select> Time</td>
  </tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td colspan=2><center>
<input type="submit" value="Generate" name="mtn" /></center></td></tr>
</table>
<center>
<span id="help_text" style="display:none">File should be supported: .3 gp, .3 g2, asf, avi, dat, divx, dsm, evo, flv, M1V, m2ts, m2v, m4a, MJ2, moov mjpg. mjpeg. mkv. mov .. mp4,. mpg,. mpeg,. mpv. nut. ogg. ogm. qt. swf. ts. vob,. wmv,. xvid.</span>
<span id="help_text2" style="display:none">Width of output image; 0:column * movie width</span>
<span id="help_text3" style="display:none">Minimum height of each shot; will reduce # of column to fit</span>
<span id="help_text4" style="display:none">Add text above output image</span>
<span id="help_text5" style="display:none">Gap between each shot</span>
<span id="help_text6" style="display:none">Save individual shots too</span>
</center>
</form>
<?php include('mtn/config.php');?>
<br /><?php
echo CREDITS;?>
<br />
</center>
<?php include(TEMPLATE_DIR.'footer.php');?>
