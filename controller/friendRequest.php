<?php
/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:04 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate");
require_once ("../classes/FriendRequest.php");
if(isset($_POST)) {
    $friendReq = new FriendRequest((int)$_SESSION["user_id"], (int)$_POST["requestee"]);
    dataBaseManipulation(SQLInsert("friend_request", $friendReq), con(), "result", "inserting into friend request", true);
}