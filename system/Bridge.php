<?php session_start() ; ob_start();

define ('_VIEW', './app/views');
define ('_CONTROLLER' , '/app/controllers');
define ('_MODEL', './app/models');
define('_LIB' , './app/lib');

include './app/config/config.php';

# Set múi giờ +7
date_default_timezone_set($config['time_zone']);

include './app/config/route.php';

include 'core/Helper.php';

# Load Helper từ app
foreach ($config['helpers'] as $configHelper) {
    include './app/helpers/' . $configHelper . '.php';
}


include 'core/DB.php';

include 'core/Controller.php';

foreach ($config['core'] as $configCore) {
    include './app/core/' . $configCore . '.php';
}

include 'core/App.php';




