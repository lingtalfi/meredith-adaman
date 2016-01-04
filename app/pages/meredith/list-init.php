<?php
use Meredith\MainController\MainControllerInterface;
use Meredith\Supervisor\MeredithSupervisor;
use Meredith\Tool\MeredithTool;

/**
 * @var MainControllerInterface $mc
 */
$ms = MeredithSupervisor::inst();

?>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {


            var rowId = 0;


            // Generate content for a column
            var table = $('.datatable-meredith').DataTable({
                ajax: {
                    url: "<?php echo $ms->getUrl("list"); ?>",
                    type: "POST"
                },
                // the columns option is necessary to enable (server side) DT_RowId to be recognized (https://datatables.net/reference/option/columns.data)
                columns: [
                    <?php
                    $c = 0;
                    $colNames2Types = $mc->getListHandler()->getColumnNames2Types();
                    foreach($colNames2Types as $col => $hasContent){
                        if(0 !== $c){
                            echo ",\n";
                        }
                        if(true === $hasContent){
                            echo '{data: "'. $col .'"}';
                        }
                        else{
                            echo '{data: null}';
                        }
                        $c++;
                    }
                    ?>
                ],
                columnDefs: [
                    <?php

                    $contentTransformers = $mc->getListHandler()->getContentTransformers();
                    $c = 0;
                    foreach($contentTransformers as $pos => $t){
                        if(0 !== $c){
                            echo ",\n";
                        }
                        echo $t->render($pos);
                        $c++;
                    }
                    ?>
                ]
            });
            $('.datatable-meredith').data("formId", "<?php echo MeredithTool::jsQuoteEscape($formId); ?>");
            $('.datatable-meredith').data("delete_rows_url", "<?php echo MeredithTool::jsQuoteEscape($ms->getUrl("delete")); ?>");
            $('.datatable-meredith').data("fetch_row_url", "<?php echo MeredithTool::jsQuoteEscape($ms->getUrl("fetchRow")); ?>");


            <?php
            echo $mc->getListHandler()->getOnModalOpenAfter()->render($mc);
            ?>


        });


        // Note that we can use
        // window.meredithRegistry here to transmit values if necessary

    })(jQuery);


</script>