<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 07:33 AM
 */

require_once ("../interfaces/Include.php");

class HeaderView implements IncludeStatement
{
    function Inclusion()
    {
        require_once ("../templates/headerView.php");
    }
}