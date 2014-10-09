<?php

global $assign_to_config, $system_path, $debug, $CFG, $URI, $IN, $OUT, $LANG, $SEC, $loader;

if ( ! isset($system_path)) {
  $system_path = "system";
}

$assign_to_config['enable_query_strings'] = TRUE;
$assign_to_config['subclass_prefix'] = 'EE_';

if (realpath($system_path) !== FALSE) {
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
define('CI_VERSION', '2.0');
define('DEBUG', isset($debug) ? $debug : 0);

require BASEPATH.'core/Common.php';
require APPPATH.'config/constants.php';

$CFG =& load_class('Config', 'core');
if (isset($assign_to_config)) {
	$CFG->_assign_to_config($assign_to_config);
}
$UNI =& load_class('Utf8', 'core');
$URI =& load_class('URI', 'core');
$SEC =& load_class('Security', 'core');
$IN	=& load_class('Input', 'core');	
$OUT =& load_class('Output', 'core');
$LANG =& load_class('Lang', 'core');

$loader = load_class('Loader', 'core');

// Load the base controller class
require BASEPATH.'core/Controller.php';

function &get_instance()
{
  return CI_Controller::get_instance();
}

function ee()
{
  return get_instance();
}

// required by the input class
if ( ! isset($_SERVER['REMOTE_ADDR']))
{
  $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
}

new CI_Controller();

ee()->load->library('core');

if (method_exists(ee()->core, 'bootstrap')) {
  ee()->core->bootstrap();
}

// if you are loading template library or addon library you'll need this
ee()->core->native_plugins = array('magpie', 'markdown', 'rss_parser', 'xml_encode');
ee()->core->native_modules = array('blacklist', 'channel', 'comment', 'commerce', 'email', 'emoticon', 'file', 'forum', 'ip_to_nation', 'jquery', 'mailinglist', 'member', 'metaweblog_api', 'moblog', 'pages', 'query', 'referrer', 'rss', 'rte', 'search', 'simple_commerce', 'stats', 'wiki');

ee()->load->library('remember');
ee()->load->library('localize');
ee()->load->library('session');
ee()->load->library('user_agent');
ee()->lang->loadfile('core');
ee()->load->helper('compat');
