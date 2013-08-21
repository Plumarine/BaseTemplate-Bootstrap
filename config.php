<?php

/* Modernizr */
define('MZ_STATE', true); // true or false
define('MZ_VER', '2.6.2');

/* jQuery */
define('JQ_CDN', false); // true or false
define('JQ_VER', '1.10.2');
define('JQ_REMOTE', '//ajax.googleapis.com/ajax/libs/jquery/'.JQ_VER.'/jquery.min.js'); // DON'T EDIT
define('JQ_LOCAL', 'js/vendor/jquery-'.JQ_VER.'.min.js'); // DON'T EDIT

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

?>