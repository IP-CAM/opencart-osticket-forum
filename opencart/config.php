<?php

#Display errors
#ini_set('display_errors',0);
#ini_set('display_startup_errors',0);

//for iframes
define('FORUM_URL', 'http://localhost/hunt_easter/newintegration/opencart/forum');
define('OSTICKET_URL', 'http://localhost/hunt_easter/newintegration/opencart/ticket');

// HTTP
define('HTTP_SERVER', 'http://localhost/hunt_easter/newintegration/opencart/');

// HTTPS
define('HTTPS_SERVER', 'http://localhost/hunt_easter/newintegration/opencart/');

// DIR
define('DIR_APPLICATION', '/var/www/html/hunt_easter/newintegration/opencart/catalog/');
define('DIR_SYSTEM', '/var/www/html/hunt_easter/newintegration/opencart/system/');
define('DIR_DATABASE', '/var/www/html/hunt_easter/newintegration/opencart/system/database/');
define('DIR_LANGUAGE', '/var/www/html/hunt_easter/newintegration/opencart/catalog/language/');
define('DIR_TEMPLATE', '/var/www/html/hunt_easter/newintegration/opencart/catalog/view/theme/');
define('DIR_CONFIG', '/var/www/html/hunt_easter/newintegration/opencart/system/config/');
define('DIR_IMAGE', '/var/www/html/hunt_easter/newintegration/opencart/image/');
define('DIR_CACHE', '/var/www/html/hunt_easter/newintegration/opencart/system/cache/');
define('DIR_DOWNLOAD', '/var/www/html/hunt_easter/newintegration/opencart/download/');
define('DIR_LOGS', '/var/www/html/hunt_easter/newintegration/opencart/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'newintegration');
define('DB_PASSWORD', 'newintegration');
define('DB_DATABASE', 'newintegration');
define('DB_PREFIX', 'oc_');
?>