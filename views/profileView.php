<?php
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("header")->Inclusion();

?>
<form>
    <input type="text" id="search" placeholder="search">
</form>
<div id="filterSearch"></div>
<h1>Friend List</h1>
<div id="friendList"></div>
<!--    <button id="friendRequest" value="lkdfdf">sdfdf</button>-->
<?php factory()->getInclusion("footer")->Inclusion();
