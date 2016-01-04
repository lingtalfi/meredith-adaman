<?php


require_once __DIR__ . "/../../../../init.php";


use Meredith\Exception\MeredithException;
use Meredith\Supervisor\MeredithSupervisor;
use QuickPdo\QuickPdo;
use Tim\TimServer\TimServer;
use Tim\TimServer\TimServerInterface;


TimServer::create()->start(function (TimServerInterface $server) {


    if (
        isset($_POST['formId']) &&
        isset($_POST['ids']) &&
        is_array($_POST['ids'])
    ) {
        $ids = $_POST['ids'];
        $view = (string)$_POST['formId'];


        if (true === MeredithSupervisor::inst()->isGranted($view, 'delete')) {


            array_walk($ids, function (&$v) {
                $v = (int)$v;
            });
            if ($ids) {
                if (false !== $nbDelete = QuickPdo::delete($view, "id in (" . implode(", ", $ids) . ")")) {
                    $server->success("ok");
                }
                else {
                    $server->error(MeredithSupervisor::inst()->translate("An error occurred with the database, please retry later"));
                }
            }
            else {
                $server->success("ok");
            }

        }
        else {
            throw new MeredithException("Permission not granted to access rows with $view");
        }
    }
    else {
        $server->error(MeredithSupervisor::inst()->translate("Invalid data"));
    }
})->output();