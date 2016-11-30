<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 07:50 AM
 */
require_once ("../interfaces/Include.php");

class SecurityInclude implements IncludeStatement
{
    function Inclusion()
    {
        require_once('../classes/Security.php');
    }
}