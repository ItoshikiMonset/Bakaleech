<!DOCTYPE html>

<head>
   <!-- flowplayer depends on jQuery 1.7.1+ (for now) -->
   <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

   <!-- flowplayer.js -->
   <script type="text/javascript" src="flowplayer.min.js"></script>

   <!-- player styling -->
   <link rel="stylesheet" type="text/css" href="flowplayer/minimalist.css">

</head>

<?php
//setlocale(LC_CTYPE, "en_US.UTF-8");
define('CONFIG_DIR', 'configs/');
define('CLASS_DIR', 'classes/');
require_once(CONFIG_DIR.'setup.php');

$PHP_SELF = !isset($PHP_SELF) ? $_SERVER ["PHP_SELF"] : $PHP_SELF;
define('ROOT_DIR', realpath("./"));
if (substr($options['download_dir'],-1) != '/') $options['download_dir'] .= '/';
define('DOWNLOAD_DIR', (substr($options['download_dir'], 0, 6) == "ftp://" ? '' : $options['download_dir']));
define('TEMPLATE_DIR', 'templates/'.$options['template_used'].'/');

require_once("classes/other.php");
login_check();

// No cache headers.
header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
header("Last-Modified:" . gmdate('D, d M Y H:i:s') . " GMT");
header("Cache-Control: no-cache, must-revalidate, max-age=0");

// Config...
//error_reporting(E_ALL);
$videoexts = array('mp4', 'divx', 'mkv', 'avi', 'mov', 'wmv', 'flv', 'mpeg', 'mpg', 'webm');

echo "<html>\n<head>\n\t<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n\t<link title='Rapidleech Style' href='".TEMPLATE_DIR."/styles/rl_style_pm.css' rel='stylesheet' type='text/css' />\n\t<title>Online Video Player</title>\n</head>\n<body>";
echo "<center><img src='".TEMPLATE_DIR."images/logo_pm.gif' alt='RapidLeech PlugMod' border='0' /></center><br />";
echo "\n<div style='text-align:center;'>\n\t";
if (!empty($_REQUEST['file']) || !empty($_REQUEST['fileurl'])) {
	if ($_REQUEST['file']) {
		$file = DOWNLOAD_DIR.basename($_REQUEST['file']);
		$url = false;
	} else {
		$file = $_REQUEST['fileurl'];
		$url = true;
	}

	$file = urldecode(str_replace(array('"', "'"), '', $file)); // Porsi. XD

	if (!$url) {
		$link = link_for_file(realpath($file), true);
		$href = " [<a href='$link'>Download</a>] ";
		$check = file_exists($file);
	} else {
		$link = $file;
		$href = " [<a href='$link' target='_blank'>Link</a>] ";
		$check = true;
	}
	$file = basename($file);

	if ($check) {
		// Reproductor
		$ext = strtolower(substr($file, strrpos($file, '.') + 1));
		if (!in_array($ext, $videoexts)) ShowForm('<h4>File Extension not found or invalid.</h4>');

		echo '<h3>Playing: "'.htmlentities($file)."\"$href</h3>\n\t";
		switch ($ext) {
			default:
				echo "<h4>No player was found for that File Extension.</h4>";
				break;

			//case ($_REQUEST['forcewmp'] == "yes"):
			case 'wmv':
			case 'mpeg':
			case 'mpg':
				EmbedWMP($link);
				break;


			case 'mov':
				EmbedDX($link);
				break;

			case 'webm':
				EmbedWebM($link);
				break;
				
			case 'divx':
			case 'avi':
			case 'mkv':
			case 'mp4':
			case 'flv':
				EmbedFLV($link);
				break;
		}
	} else {
		// No encontrado
		echo "<h4>File not found.</h4>";
	}
} else {
	echo "<h3>Select a video and press 'Play Video' button.</h3>";
}

ShowForm();

function GetFiles() {
	global $videoexts;
	$file = array();
	$d = dir(DOWNLOAD_DIR);
	while (false !== ($fn = $d->read())) {
		$ext = strtolower(substr($fn, strrpos($fn, '.') + 1));
		if (in_array($ext, $videoexts) && strpos($fn, '?') === false) {
			$file[] = $fn;
		}
	}
	$d->close();
	return $file;
}

function ShowForm($err = false) {
	global $file;
	$files = GetFiles();
	if ($err) echo $err;
	echo "\n\t<form method='POST'><br />\n";
	echo "\t\t<select name='file' style='max-width:600px;'>\n";
	foreach($files as $f) echo "\t\t\t<option value='".urlencode($f).(!empty($file) && $file == $f ? "'selected='selected'>" : "'>").htmlentities($f)."</option>\n";//, ENT_QUOTES, 'UTF-8'
	echo "\t\t</select><br /><br />\n";
	//echo "\t\t<input type='checkbox' name='forcewmp' value='yes'".($_REQUEST['forcewmp'] == 'yes' ? " checked='checked'" : '')." /> Use WMP?&nbsp;\n";
	echo "\t\t<input type='submit' name='T822' value='Play Video' />\n\t</form>\n</div>\n</body>\n<!-- Written by Th3-822 -->\n</html>";
	if ($err) exit;
}

function EmbedDX($url) {
	//704 x 368+20
	echo "<object id='divxwebplayer' classid='clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616' width='704' height='388' codebase='http://go.divx.com/plugin/DivXBrowserPlugin.cab'>\n\t\t<param name='custommode' value='none' />\n\t\t<param name='autoPlay' value='true' />\n\t\t<param name='src' value='$url' />\n\t\t<embed type='video/divx' src='$url' custommode='none' width='704' height='388' autoPlay='true' pluginspage='http://go.divx.com/plugin/download/'>\n\t\t</embed>\n\t</object>\n\t<br />No video? <a href='http://www.divx.com/software/divx-plus/web-player' target='_blank'>Download</a> the DivX Plus Web Player.<br /><!-- Th3-822 was here -->";
}

function EmbedWMP($url) {
	//704 x 368+68
	echo "<object id='wmplayer' classid='clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#version=5,1,52,701' standby='[T-8] Loading Microsoft® Windows® Media Player components...' type='application/x-oleobject' width='704' height='436'>\n\t\t<param name='filename' value='$url'>\n\t\t<param name='animationatstart' value='true'>\n\t\t<param name='transparentatstart' value='true'>\n\t\t<param name='autostart' value='true'>\n\t\t<param name='showcontrols' value='true'>\n\t\t<param name='ShowStatusBar' value='true'>\n\t\t<embed type='application/x-mplayer2' src='$url' autostart='1' showcontrols='1' showstatusbar='1' animationatstart='1' transparentatstart='1' width='704' height='436'>\n\t</object><br /><!-- Th3-822 was here too -->";
}

function EmbedWebM($url) {
	//704 x 368
	echo "<video id='videotag' width='704' height='368' controls='controls'>\n\t\t<source src='$url' type='video/webm; codecs=\"vorbis,vp8\"'>\n\t\t<h4>Your browser does not support the HTML5 video tag...,</h4>\n\t</video><br /><!--T-8-->";
}

function EmbedFLV($url) {
	//704 x 368
	echo "<object id='flowplayer' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='704' height='368'>\n\t\t<param name='movie' value='flowplayer/flowplayer.swf' />\n\t\t<param name='allowfullscreen' value='true' />\n\t\t<param name='flashvars' value='config={\"clip\":\"$url\"}' />\n\t\t<embed type='application/x-shockwave-flash' width='704' height='368' src='flowplayer/flowplayer.swf' allowfullscreen='true' flashvars='config={\"clip\":\"$url\"}'/>\n\t</object><!-- T-8:I don't wanna add js... http://flowplayer.org/demos/installation/alternate/index.html -->";
}

//  Th3-822

?>
