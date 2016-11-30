<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 08:15 AM
 */

require_once ("HeaderView.php");
require_once ("Footer.php");
require_once ("Database.php");
require_once ("SecurityInclude.php");
require_once ("Functions.php");



class IncludeFactory
{

    public function getInclusion($type)
    {
       switch ($type)
       {
           case "header":
               return new HeaderView();
               break;
           case "footer":
               return new Footer();
               break;
           case "dataB":
               return new Database();
               break;
           case "functions":
               return new Functions();
               break;
           case "security":
               return new SecurityInclude();
               break;
           default:
               return null;

       }
    }

}