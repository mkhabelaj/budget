<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 07:44 AM
 */
require_once ("../interfaces/Include.php");
class Functions implements IncludeStatement
{
    function Inclusion()
    {
        require_once ("../functions/functions.php");
    }
}