<?php
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("header")->Inclusion();

?>

<?php factory()->getInclusion("footer")->Inclusion();
