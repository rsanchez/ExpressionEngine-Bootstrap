<?php
if (!isset($system_path)) {
    $system_path = "system";
}

$assign_to_config['enable_query_strings'] = TRUE;
$assign_to_config['subclass_prefix'] = 'EE_';


if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';


define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', str_replace("\\", "/", $system_path.'codeigniter/system/'));
define('APPPATH', $system_path.'expressionengine/');
define('FCPATH', str_replace(SELF, '', __FILE__));
define('SYSDIR', trim(strrchr(trim(str_replace("\\", "/", $system_path), '/'), '/'), '/'));
define('UTF8_ENABLED', false);
define('CI_VERSION', '2.0');
//define('AJAX_REQUEST',false);
define('DEBUG',false);

require BASEPATH.'core/Common'.EXT;
require APPPATH.'config/constants'.EXT;

$CFG =& load_class('Config', 'core');
$URI =& load_class('URI', 'core');
$IN	=& load_class('Input', 'core');	
$OUT =& load_class('Output', 'core');
$LANG =& load_class('Lang', 'core');
$SEC =& load_class('Security', 'core');

$loader = load_class('Loader', 'core');

// Load the base controller class
require BASEPATH.'core/Controller'.EXT;

function &get_instance()
{
    return CI_Controller::get_instance();
}

function ee()
{
    static $EE;
    if ( ! $EE) $EE = get_instance();
    return $EE;
}

class EE_Bootstrap_Controller extends CI_Controller {}

$EE = new EE_Bootstrap_Controller;

$loader->library('core');

ee()->core->bootstrap();
