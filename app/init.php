<?php


//------------------------------------------------------------------------------/
// PHP CONFIGURATION
//------------------------------------------------------------------------------/
use BumbleBee\Autoload\ButineurAutoloader;
use Meredith\Dictionary\EnglishDictionary;
use Meredith\MainControllerProvider\MainControllerProvider;
use Meredith\Supervisor\MeredithSupervisor;
use QuickPdo\QuickPdo;

date_default_timezone_set('Europe/Paris');
ini_set('error_reporting', -1);
mb_internal_encoding('UTF-8');

//------------------------------------------------------------------------------/
// INCLUDE FUNCTIONS AND AUTOLOADER CLASS
//------------------------------------------------------------------------------/
require_once __DIR__ . "/functions/az.php";
require_once __DIR__ . '/planets/BumbleBee/Autoload/BeeAutoloader.php';
require_once __DIR__ . '/planets/BumbleBee/Autoload/ButineurAutoloader.php';


//------------------------------------------------------------------------------/
// INIT THE AUTOLOADER
//------------------------------------------------------------------------------/
ButineurAutoloader::getInst()
    ->addLocation(__DIR__ . "/planets")
    ->start();


//------------------------------------------------------------------------------/
// GENERAL
//------------------------------------------------------------------------------/
define('APP_DIR', __DIR__);

//------------------------------------------------------------------------------/
// DB SETTINGS
//------------------------------------------------------------------------------/
define("MYSQL_DBNAME", "adaman");
define("PDOCONF_DSN", "mysql:dbname=" . MYSQL_DBNAME . ";host=127.0.0.1");
define("PDOCONF_USER", "root");
define("PDOCONF_PASS", "root");
define('COOKIE_DOMAIN', "");


// Initialize pdo connection now, since we will need it for almost every request.
//------------------------------------------------------------------------------/
QuickPdo::setConnection(
    PDOCONF_DSN,
    PDOCONF_USER,
    PDOCONF_PASS,
    array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    )
);


//------------------------------------------------------------------------------/
// MEREDITH plugin
//------------------------------------------------------------------------------/
MeredithSupervisor::inst()
    ->setGetMainControllerCb(function ($formId) {
        $mc = MainControllerProvider::create()
            ->setDir(APP_DIR . "/pages/meredith/main-controllers")
            ->getMainController($formId); // getMainController either works as expected, or throws an Exception in your face ...
        return $mc;
    })
    ->setIsGranted(function ($formId, $action) {
        // your application permission system here...
        return true;
    })
    ->setTranslateCb(function ($msg) {
        if (false !== $tr = EnglishDictionary::inst()->search($msg)) {
            return $tr;
        }
        return $msg;
    })
    ->setLogCb(function ($msg) {
        // your application logging system here...
    });









