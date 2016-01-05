<?php


/**
 * @var MainControllerInterface $mc
 */
use Meredith\MainController\MainControllerInterface;


?>

<!-- main table -->
<table class="table datatable-meredith table-framed table-bordered table-striped table-hover">
    <thead>
    <tr>
        <?php
        $listColumnLabels = $mc->getListHandler()->getColumnLabels();
        foreach ($listColumnLabels as $label): ?>
            <th><?php echo $label; ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
</table>
<!-- /main table -->




<!-- edit modal -->
<div id="meredith_edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit</h5>
            </div>

            <div class="modal-body">
                <?php
                echo $mc->getFormHandler()->render($mc);
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /edit modal -->



<!-- remove modal -->
<div id="meredith_remove_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Confirmation</h5>
            </div>

            <div class="modal-body">
                Are you sure you want to delete these rows (irreversible)?
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-link"
                        type="button">No
                </button>
                <button id="meredith_remove_row_confirm" data-dismiss="modal" class="btn btn-warning"
                        type="button">Yes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /remove modal -->




<!-- warning modal -->
<div class="modal fade in" id="meredith_warning_modal" style="padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h6 class="modal-title">Warning</h6>
            </div>

            <div class="modal-body">
                <p class="modal-body-paragraph">Oops, an error occurred!</p>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-warning" type="button">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- /warning modal -->



<?php require_once __DIR__ . "/../meredith/list-init.php"; ?>
<?php echo $mc->getListHandler()->getPreConfigScript()->render($mc); ?>