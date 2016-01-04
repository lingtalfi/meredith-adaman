<?php


use Meredith\Supervisor\MeredithSupervisor;

require_once __DIR__ . "/../init.php";


?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Adaman application</title>


    <!-- ---------------------------------------------------------- -->
    <!-- CLOUDY THINGS -->
    <!-- ---------------------------------------------------------- -->
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <script
        src="https://raw.githubusercontent.com/firstopinion/formatter.js/master/dist/jquery.formatter.min.js"></script>

    <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.0/js/buttons.colVis.min.js"></script>


    <script type="text/javascript"
            src="https://raw.githubusercontent.com/lingtalfi/Tim/master/js/tim-functions/tim-functions.js"></script>
    <script type="text/javascript"
            src="https://raw.githubusercontent.com/macek/jquery-serialize-object/master/jquery.serialize-object.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.switchery/0.8.1/switchery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>


    <script src="//cdn.bootcss.com/bootbox.js/4.4.0/bootbox.min.js"></script>


    <!--  -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.switchery/0.8.1/switchery.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


    <!-- ---------------------------------------------------------- -->
    <!-- LOCAL THINGS -->
    <!-- For some reasons, switchery had to be local in order to work properly
    <!-- ---------------------------------------------------------- -->

    <script type="text/javascript" src="/libs/meredith/js/meredith.js"></script>
    <script type="text/javascript" src="/libs/meredith/js/meredith-config.js"></script>
    <script type="text/javascript" src="/js/pages/users.js"></script>
    <link rel="stylesheet" href="/libs/meredith/css/meredith.style.css">
    <link rel="stylesheet" href="/libs/icomoon/style.css">

    <link rel="stylesheet" href="/css/my_style.css">

</head>

<body>

<nav>
    <a href="/users-form">Add user</a><br>
    <a href="/users-list">User list</a><br>
</nav>

<section>
    <?php
    //------------------------------------------------------------------------------/
    // PSEUDO ROUTING MECHANISM
    //------------------------------------------------------------------------------/
    $uri = $_SERVER['REQUEST_URI'];
    $page = 'default';


    $uri2FormId = [
        '/users-form' => 'users',
        '/users-list' => 'users',
    ];
    if (array_key_exists($uri, $uri2FormId)) {
        $formId = $uri2FormId[$uri];
        $page = substr($uri, 1); // remove the leading slash
        MeredithSupervisor::inst()->setFormId($formId);
    }


    require_once APP_DIR . "/pages/" . $page . ".php";
    ?>
</section>

</body>
</html>