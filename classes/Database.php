<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 07:57 AM
 */
require_once ("../interfaces/Include.php");

class Database implements IncludeStatement
{
    function Inclusion()
    {
        include ("../database/databaseConnection.php");
    }
}