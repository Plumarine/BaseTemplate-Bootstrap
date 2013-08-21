<?php

function meta_html() {
    preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $val);

    if (count($val) > 1) {
        $ver = $val[1];

        switch(true) {
            case ($ver < 7):
                $res = '<html class="no-js lt-ie9 lt-ie8 lt-ie7">';
            break;
            case ($ver == 7):
                $res = '<html class="no-js lt-ie9 lt-ie8">';
            break;
            case ($ver == 8):
                $res = '<html class="no-js lt-ie9">';
            break;
            default:
                $res = '<html class="no-js">';
            break;
        }
    } else {
        $res = '<html class="no-js">';
    }

    return (string)$res."\n";
}


function checkJQUERY($state) {
    if (@file_exists(JQ_LOCAL)) {
        $state_jq_local = true;
    } else {
        $state_jq_local = false;
    }

    if ($state) {
        if (@fopen('http:'.JQ_REMOTE, 'r')) {
            $res = "\t\t".'<script defer src="'.JQ_REMOTE.'" defer></script>'."\n";

            if ($state_jq_local) {
                $res.= "\t\t".'<script defer>window.jQuery || document.write(\'<script defer src="gzip.php?f='.JQ_LOCAL.'"><\/script>\')</script>'."\n";
            }
        } else {
            $res = "\t\t".'<script defer src="gzip.php?f='.JQ_LOCAL.'"></script>'."\n";
        }
    } else {
        if ($state_jq_local) {
            $res = "\t\t".'<script defer src="gzip.php?f='.JQ_LOCAL.'"></script>'."\n";
        } else {
            $res = null;
        }
    }

    return (string)$res;
}


function checkGA_SA($sa, $dom) {
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

    return "\t\t"."<script defer>".(string)$res."</script>"."\n";
}


function social_network(){
    $array = array(
        "fb" => array("state" => (boolean)SN_FACEBOOK, "script" => (string)SN_FACEBOOK_JS),
        "gg" => array("state" => (boolean)SN_GOOGLE,   "script" => (string)SN_GOOGLE_JS),
        "tw" => array("state" => (boolean)SN_TWITTER,  "script" => (string)SN_TWITTER_JS)
    );

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
        return "\t\t"."<script defer>".(string)$res."</script>"."\n";
    }
}

?>