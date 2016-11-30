<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 09:45 AM
 */

require_once ('../classes/IncludeFactory.php');
function factory(){
    return new IncludeFactory();
}
$factory = new IncludeFactory();
