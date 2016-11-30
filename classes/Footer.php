<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 07:40 AM
 */
require_once ("../interfaces/Include.php");

class Footer implements IncludeStatement
{
    function Inclusion()
    {
        require_once ("../templates/footer.php");
    }
}