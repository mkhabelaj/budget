<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-19
 * Time: 08:36 AM
 */
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("header")->Inclusion();
$time_line_id;
echo "hi this is your budget ".$_GET["budget_instance_id"];
?>

<div id="test"></div>



<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">
            X
        </span>
        <div class="modal-sub-content"></div>
    </div>
</div>
<script type="application/javascript" src="../js/budgetView.js"></script>
<script type="application/javascript" src="../js/modal.js"></script>
<?php
factory()->getInclusion("footer")->Inclusion();
?>
