<h1>Add user</h1>
<div>
    <?php

    use Meredith\Supervisor\MeredithSupervisor;

    $formId = MeredithSupervisor::inst()->getFormId();
    $mc = MeredithSupervisor::inst()->getMainController($formId);
    echo $mc->getFormHandler()->render($mc);
    
    ?>
</div>