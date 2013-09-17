<?php

/* *** NO CHANGE *** */
define('URL', dirname(strtolower($_SERVER['SERVER_PROTOCOL'])).'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
/* ***************** */


/* Modernizr */
define('MZ_STATE', true); // true or false
define('MZ_VER', '2.6.2');

/* FlowType */
define('FT_STATE', false); // true or false
define('FT_VER', '1.0.0');

/* Normalize */
define('NZ_NEW_BROWSER_STATE', false); // true or false
define('NZ_NEW_BROWSER_VER', '2.1.3');
define('NZ_OLD_BROWSER_VER', '1.1.2');

/* jQuery */
define('JQ_CDN', false); // true or false
define('JQ_VER_USE', 1); // 1 or 2
define('JQ_VER_1X', '1.10.2');
define('JQ_VER_2X', '2.0.3');

/* Google Analytics */
define('GA_STATE', false); // true or false
define('GA_SA', '');
define('GA_DOM', '');

/* Language Browser */
define('LANG', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)); // DON'T EDIT
define('LANG_DEFAULT', 'en');

/* Social Network */
define('SN_FACEBOOK', false);
define('SN_GOOGLE', false);
define('SN_TWITTER', false);
define('SN_FACEBOOK_JS', "(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src='//connect.facebook.net/fr_FR/all.js#xfbml=1';fjs.parentNode.insertBefore(js,fjs);}(document,'script','facebook-jssdk'));");
define('SN_GOOGLE_JS', "window.___gcfg={lang:'".LANG."'};(function(){var po=document.createElement('script');po.type='text/javascript';po.async=true;po.src='https://apis.google.com/js/plusone.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(po,s);})();");
define('SN_TWITTER_JS', "!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');");

$arr_sn = array(
    "fb" => array("state" => (boolean)SN_FACEBOOK, "script" => (string)SN_FACEBOOK_JS),
    "gg" => array("state" => (boolean)SN_GOOGLE, "script" => (string)SN_GOOGLE_JS),
    "tw" => array("state" => (boolean)SN_TWITTER, "script" => (string)SN_TWITTER_JS)
);

/* Open Graph */
define('OG_STATE', false); // true or false
define('OG_TITLE', 'domProjects');
define('OG_TYPE', 'website');
define('OG_DESCRIPTION', 'Web projects based HTML, CSS, Javascript and PHP');
define('OG_IMAGE', URL.'img/logo-512.png');
define('OG_URL', 'http://www.domprojects.com');

$arr_og = array(
    "title" => (string)OG_TITLE,
    "type" => (string)OG_TYPE,
    "description" => (string)OG_DESCRIPTION,
    "url" => (string)OG_URL,
    "image" => (string)OG_IMAGE
);

?>