<?php

function meta_html() {
    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $val);

    if (count($val) > 1) {
        $ver = $val[1];

        switch(true) {
            case ($ver < 7):
                $res = 'no-js lt-ie9 lt-ie8 lt-ie7';
            break;
            case ($ver == 7):
                $res = 'no-js lt-ie9 lt-ie8';
            break;
            case ($ver == 8):
                $res = 'no-js lt-ie9';
            break;
            default:
                $res = 'no-js';
            break;
        }
    } else {
        $res = 'no-js';
    }

    if (OG_STATE) {
        $opengraph = ' prefix="og: http://ogp.me/ns#"';
    } else {
        $opengraph = null;
    }

    print('<html class="'.(string)$res.'"'.$opengraph.'>'."\n");
}


function check_jquery($state, $ver_use) {
    global $var;
    switch($ver_use) {
        case 1:  $ver = JQ_VER_1X; break;
        case 2:  $ver = JQ_VER_2X; break;
        default: $ver = 0; break;
    }

    if ($ver != 0){
        $lib_remote = 'http://ajax.googleapis.com/ajax/libs/jquery/'.$ver.'/jquery.min.js';
        $lib_local  = 'js/vendor/jquery-'.$ver.'.min.js';

        if (@file_exists($lib_local)) {
            $state_jq_local = true;
        } else {
            $state_jq_local = false;
        }

        if ($state) {
            if (@fopen($lib_remote, 'r')) {
                $res = "\t\t".'<script defer src="'.$lib_remote.'"></script>'."\n";

                if ($state_jq_local) {
                    $res.= "\t\t".'<script defer>window.jQuery || document.write(\'<script defer src="gzip.php?f='.$lib_local.'"><\/script>\')</script>'."\n";
                }
            } else {
                $res = "\t\t".'<script defer src="gzip.php?f='.$lib_local.'"></script>'."\n";
            }
        } else {
            if ($state_jq_local) {
                $res = "\t\t".'<script defer src="gzip.php?f='.$lib_local.'"></script>'."\n";
            } else {
                $res = null;
            }
        }

        define('JQ_STATE', true);
        echo (string)$res;
    } else {
        define('JQ_STATE', false);
        $var.= 'var $jq_state=false;';
    }
}


function check_ga_sa($sa, $dom) {
    $check = '#^UA+-[0-9]+-[0-9]{1,2}$#';

    if (!empty($sa)) {
        $val_sa = trim($sa);

        if (preg_match($check, $val_sa)) {
            $res = "var _gaq =_gaq || [];";
            $res.= "_gaq.push(['_setAccount','".$val_sa."']);";

            if (!empty($dom)){
                $res.= "_gaq.push(['_setDomainName','".trim($dom)."']);";
            }

            $res.= "_gaq.push(['_trackPageview']);";
            $res.= "(function(){";
            $res.= "var ga=document.createElement('script');";
            $res.= "ga.type='text/javascript';";
            $res.= "ga.async=true;";
            $res.= "ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';";
            $res.= "var s=document.getElementsByTagName('script')[0];";
            $res.= "s.parentNode.insertBefore(ga,s);";
            $res.= "})();";
        } else {
            $res = "alert('Error : Google Analytics >> setAccount (GA_SA)');";
        }
    } else {
        $res = "alert('Error : Google Analytics >> setAccount empty (GA_SA)');";
    }

    print("\t\t"."<script defer>".(string)$res."</script>"."\n");
}


function social_network($array){
    $res = null;
    $i = 0;

    foreach($array as $key1=>$value1) {
        if ($value1['state'] === true) {
            foreach ($value1 as $key2=>$value2) {
                if ($value2 != 1) {
                    $res.= trim($value2);
                }
            }
            $i++;
        }
    }

    if ($i > 0) {
        print("\t\t"."<script defer>".(string)$res."</script>"."\n");
    }
}


function open_graph($array){
    $res = null;
    $i = 0;

    foreach($array as $key=>$value) {
        if (!empty($value)) {
            if ($key === 'image') {
                list ($width, $height, $type, $attr) = info_image($value);
                $res.= "\t\t".'<meta property="og:image" content="'.trim($value).'">'."\n";
                $res.= "\t\t".'<meta property="og:image:type" content="'.$type.'">'."\n";
                $res.= "\t\t".'<meta property="og:image:width" content="'.$width.'">'."\n";
                $res.= "\t\t".'<meta property="og:image:height" content="'.$height.'">'."\n";
            } else {
                $res.= "\t\t".'<meta property="og:'.trim(strtolower($key)).'" content="'.trim($value).'">'."\n";
            }
            $i++;
        }
    }

    if ($i > 0) {
        print((string)$res);
    }
}


function info_image($img){
    list($width, $height, $type, $attr) = getimagesize($img);
    switch($type){
        case 1:  $type = 'image/gif'; break;
        case 2:  $type = 'image/jpeg'; break;
        case 3:  $type = 'image/png'; break;
        case 4:  $type = 'application/x-shockwave-flash'; break;
        case 5:  $type = 'image/psd'; break;
        case 6:  $type = 'image/bmp'; break;
        case 7:  $type = 'image/tiff'; break;
        case 8:  $type = 'image/tiff'; break;
        case 9:  $type = 'application/octet-stream'; break;
        case 10: $type = 'image/jp2'; break;
        case 11: $type = 'application/octet-stream'; break;
        case 12: $type = 'application/octet-stream'; break;
        case 13: $type = 'application/x-shockwave-flash'; break;
        case 14: $type = 'image/iff'; break;
        case 15: $type = 'image/vnd.wap.wbmp'; break;
        case 16: $type = 'image/xbm'; break;
        case 17: $type = 'image/vnd.microsoft.icon'; break;
    }
    return array($width, $height, $type, $attr);
}

?>