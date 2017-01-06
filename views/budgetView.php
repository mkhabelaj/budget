<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-19
 * Time: 08:36 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes('header',"functions","validate");

$time_line_id;
echo "hi this is your budget ".$_GET["budget_instance_id"];
?>

<div id="budget-view" class="container"></div>
<div id="test"></div>

<?php
factory()->getInclusion("footer")->Inclusion();
?>
