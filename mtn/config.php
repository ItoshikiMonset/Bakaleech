<?php
if (!defined('RAPIDLEECH')) {
	require('../index.html');
	exit;
}
?>
<?php
if ($_POST['video']!="")
{
$w=$_POST['w'];
    $files = $options['download_dir']."$vdofile";
	if ($_POST['all']=="true")
	{
		$video = vidlist($options['download_dir']);
	}
	else
	{
		$video=array();		
		$video[0] = $_POST['video'];
	}
	if ($_POST['cs']>0 && $_POST['cs']<6)
	{
		$c=$_POST['cs'];
	}
	else
	{
		$c=" 1";
	}
	if ($_POST['rs']>0 && $_POST['rs']<11)
	{
		$r=$_POST['rs'];
	}
	else
	{
		$r=" 1";
	}
foreach ($video as $vdo)
{
	$cmd=getcwd()."/mtn/mtn";
	if ($_POST['i']=="")
	{
		$cmd.=" -i";
	}
	if ($_POST['t']=="")
	{
		$cmd.=" -t";
	}
	if ($w!="" && $w>0 && $w<2001)
	{
		$cmd.=" -w $w";
	}
	$cmd.=" -T '".$_POST['T']."' -f 'mtn/".$_POST['f']."' -b 0.60 -B 0.0 -C 6000 -D 8 -g ".$_POST['g']." -h ".$_POST['h']." '".$_POST['I']."' -L '".$_POST['iL'].":".$_POST['tL']."' -F '".$_POST['Tc'].":".$_POST['Ts'].":'mtn/".$_POST['f']."':".$_POST['tc'].":".$_POST['ts'].":".$_POST['Ts']."' -j ".$_POST['j']." -k ".$_POST['k']." -E 0.0 -c ".$c." -r ".$r." '".getcwd()."/$files/".$vdo."'";
	shell_exec($cmd);
	$ext=strtolower(strrchr($vdo,'.'));
	$vdofile=str_ireplace($ext,"_s.jpg",$vdo);
	if (file_exists(getcwd()."/$files/".$vdofile))
	{
         $image = $options['download_dir']."$vdofile";
		echo '<h2><a href="'.$options['download_dir'].''.$vdofile.'">'.$vdo.'</a></h2>';
	}
	else
	{
		echo '<BR />Error in generating <b><i>'.$vdo.'</i></b> <BR />';
	}
                echo "<img src=\"$image\">";
}
}
?>
