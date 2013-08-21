<?php

$file = isset($_GET['f']) ? $_GET['f'] : null;

if (!empty($file)) {
    $parts     = explode('.', $file);
    $extension = substr(strrchr($file, '.'), 1);
    //$extension = $parts[count($parts) - 1];

    switch ($extension) {
        case 'php':  exit(0); break;
        case 'css':  $type = 'text/css'; break;
        case 'js':   $type = 'text/javascript'; break;
        case 'xml':  $type = 'text/xml'; break;
        case 'htm':  $type = 'text/html'; break;
        case 'html': $type = 'text/html'; break;
        default:     $type = 'text/plain'; break;
    }

    if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') AND extension_loaded('zlib')) {
        ob_start('ob_gzhandler');
    } else {
        ob_start();
    }

    if (file_exists($file)) {
        header("Last-Modified: ".gmdate("D, d M Y H:i:s",time()-36000)." GMT");
        header("Content-type: $type; charset: utf-8");

	   echo file_get_contents($file);

        if (extension_loaded('zlib')){
            ob_end_flush();
        }
    } else {
        header('HTTP/1.0 404 Not Found');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}

?>