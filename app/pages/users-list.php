<?php



//------------------------------------------------------------------------------/
// CONFIGURATION OF MEREDITH MAIN CONTROLLER
//------------------------------------------------------------------------------/
use Meredith\Supervisor\MeredithSupervisor;



$formId = "users";
$mc = MeredithSupervisor::inst()->getMainController($formId);
require_once __DIR__ . "/inc/baselist.php";


