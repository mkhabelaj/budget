<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-05
 * Time: 11:04 AM
 */
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
factory()->getInclusion("header")->Inclusion();
?>
<h2>Notification Center</h2>
<div id="allNotifications"></div>
<script type="application/javascript" src="../js/notificationCenter.js"></script>
<?php
factory()->getInclusion("footer")->Inclusion();
?>
