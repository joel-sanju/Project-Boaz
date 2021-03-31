<?php
session_start(); 


require '../connect/config.php';

if(isset($_SESSION['admina']) || isset($_SESSION['uid'])){
	$pass = true;
 }
else{
	
	die('auttentication error. Please refresh browser and login');
	
	}



	$fd1 = $_GET['fd1'];
	$fd2 = $_GET['fd2'];
	
	$fpath = $fd1.".".pathinfo($fd2, PATHINFO_EXTENSION);
	
	$fpath_nx = explode('_', $fd1);
	
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != $fpath_nx[0]) die('Try again');
	
	$folder = date("Y/m/", (int)$fpath_nx[1]).$fpath;

    header("Content-Type: ".getFileMimeType($folder));
	readfile($folder);
	
	
	
	
	
	
	
	function getFileMimeType($file) {
    if (function_exists('finfo_file')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_file($finfo, $file);
        finfo_close($finfo);
    } else {
        $type = mime_content_type($file);
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        $secondOpinion = exec('file -b --mime-type ' . escapeshellarg($file), $foo, $returnCode);
        if ($returnCode === 0 && $secondOpinion) {
            $type = $secondOpinion;
        }
    }

    if (!$type || in_array($type, array('application/octet-stream', 'text/plain'))) {
        $exifImageType = exif_imagetype($file);
        if ($exifImageType !== false) {
            $type = image_type_to_mime_type($exifImageType);
        }
    }

    return $type;
}
	
	
	
	