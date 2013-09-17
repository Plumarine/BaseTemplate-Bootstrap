<?php

header('Content-Type: text/html; charset=utf-8');

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') AND extension_loaded('zlib')) {
    ob_start('ob_gzhandler');
} else {
    ob_start();
}

require(realpath(dirname(__FILE__).'/config.php'));
require(realpath(dirname(__FILE__).'/function.php'));

?>
<!DOCTYPE html>
<?php meta_html(); ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>BaseTemplate-Boostrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php

if (OG_STATE) { open_graph($arr_og); }

if (NZ_NEW_BROWSER_STATE) {
    echo "\t\t".'<link rel="stylesheet" href="gzip.php?f=css/normalize-'.NZ_NEW_BROWSER_VER.'.css">'."\n";
} else {
    echo "\t\t".'<link rel="stylesheet" href="gzip.php?f=css/normalize-'.NZ_OLD_BROWSER_VER.'.css">'."\n";
}
?>
        <link rel="stylesheet" href="gzip.php?f=css/bootstrap.min.css">
        <link rel="stylesheet" href="gzip.php?f=css/main.css">
        <link rel="shortcut icon" href="<?php echo URL; ?>favicon.ico?v=1">
        <link rel="icon" sizes="16x16 32x32" href="favicon.ico?v=1">
<?php if (MZ_STATE) { echo "\t\t".'<script defer src="gzip.php?f=js/vendor/modernizr-'.MZ_VER.'.min.js"></script>'."\n"; } ?>
        <!--[if lt IE 9]><script defer src="gzip.php?f=js/vendor/respond.min.js"></script><![endif]-->
    </head>
    <body>

        <div class="container">

            <div class="row">
                <div class="col-md-12">

                </div>
            </div>

        </div>

<?php

    $var = null;

    if (SN_FACEBOOK) { echo "\t\t".'<div id="fb-root"></div>'."\n\n"; }

    check_jquery(JQ_CDN, JQ_VER_USE);

    if (FT_STATE && JQ_STATE) {
        echo "\t\t".'<script defer src="gzip.php?f=js/vendor/flowtype-'.FT_VER.'.js"></script>'."\n";
        $var.= 'var $ft_state=true;';
    } else {
        $var.= 'var $ft_state=false;';
    }

    if (JQ_STATE) {
        echo "\t\t".'<script defer src="gzip.php?f=js/vendor/bootstrap.min.js"></script>'."\n";
        echo "\t\t".'<script defer>'.$var.'</script>'."\n";
        echo "\t\t".'<script defer src="gzip.php?f=js/main.js"></script>'."\n";
    }

    social_network($arr_sn);

    if (GA_STATE) { check_ga_sa(GA_SA, GA_DOM); }

?>
    </body>
</html>
<?php

if (extension_loaded('zlib')){
    ob_end_flush();
}

?>