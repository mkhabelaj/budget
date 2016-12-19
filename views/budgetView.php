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

<script type="application/javascript" src="../js/budgetView.js"></script>
<?php
factory()->getInclusion("footer")->Inclusion();
?>
