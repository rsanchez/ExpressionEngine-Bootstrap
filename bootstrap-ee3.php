<?php

global $assign_to_config, $system_path, $debug;

if ( ! isset($system_path)) {
  $system_path = "system";
}

if (realpath($system_path) !== FALSE) {
  $system_path = realpath($system_path).'/';
}

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('EXT', '.php');
define('BASEPATH', $system_path.'ee/legacy/');
define('FCPATH', str_replace(SELF, '', __FILE__));
define('SYSDIR', pathinfo($system_path, PATHINFO_BASENAME));
define('CI_VERSION', '2.0');
define('DEBUG', isset($debug) ? $debug : 0);
define('SYSPATH', $system_path);

require_once $system_path.'ee/legacy/config/constants.php';
require_once $system_path.'ee/EllisLab/ExpressionEngine/Boot/boot.common.php';
require_once $system_path.'ee/EllisLab/ExpressionEngine/Core/Autoloader.php';
require_once $system_path.'ee/legacy/core/Controller.php';

$autoloader = EllisLab\ExpressionEngine\Core\Autoloader::getInstance();

$autoloader->addPrefix(
    'EllisLab',
    $system_path.'ee/EllisLab/'
);

$autoloader->addPrefix(
    'Michelf',
    $system_path.'ee/legacy/libraries/typography/Markdown/Michelf/'
);

$autoloader->register();

class EE3_Bootstrap extends EllisLab\ExpressionEngine\Core\ExpressionEngine
{
    public function boot($assign_to_config = null)
    {
        parent::boot();

        $app = $this->loadApplicationCore();

        if (isset($assign_to_config)) {
            $this->overrideConfig($assign_to_config);
        }

        $this->getLegacyApp()->getFacade()->load->library('core');

        $this->getLegacyApp()->getFacade()->core->bootstrap();

        Controller::_setFacade($this->getLegacyApp()->getFacade());

        new Controller();
    }

    public static function getInstance()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new static;
        }

        return $instance;
    }
}

function get_instance() {
    return EE3_Bootstrap::getInstance()->getLegacyApp()->getFacade();
}

function ee($make = null) {
    if (func_num_args() === 0) {
        return EE3_Bootstrap::getInstance()->getLegacyApp()->getFacade();
    }

    return call_user_func_array([EE3_Bootstrap::getInstance()->getLegacyApp()->getFacade()->di, 'make'], func_get_args());
}

EE3_Bootstrap::getInstance()->boot(isset($assign_to_config) ? $assign_to_config : null);
