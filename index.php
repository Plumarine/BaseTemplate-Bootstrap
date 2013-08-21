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
<?php echo meta_html(); ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TemplateBase-Boostrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="gzip.php?f=css/bootstrap.min.css">
        <link rel="stylesheet" href="gzip.php?f=css/main.css">
        <?php if (MZ_STATE) { echo '<script defer src="gzip.php?f=js/vendor/modernizr-'.MZ_VER.'.min.js"></script>'."\n"; } ?>
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

    if (SN_FACEBOOK) { echo "\t\t".'<div id="fb-root"></div>'."\n\n"; }

    echo checkJQUERY(JQ_CDN);
?>
        <script defer src="gzip.php?f=js/vendor/bootstrap.min.js"></script>
        <script defer src="gzip.php?f=js/main.js"></script>
<?php

    echo social_network();

    if (GA_STATE) { echo checkGA_SA(GA_SA, GA_DOM); }

?>
    </body>
</html>
<?php

if (extension_loaded('zlib')){
    ob_end_flush();
}

?>