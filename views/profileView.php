<?php
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("header")->Inclusion();

?>
<form>
    <input type="text" id="search" placeholder="search">
</form>
<div id="filterSearch"></div>
<!--    <button id="friendRequest" value="lkdfdf">sdfdf</button>-->
    <script type="application/javascript" src="../js/friendSearch.js"></script>
<?php factory()->getInclusion("footer")->Inclusion();
