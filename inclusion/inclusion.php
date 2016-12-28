<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-26
 * Time: 09:45 AM
 */

require_once ('../classes/IncludeFactory.php');
/**
 * creates a factory for file includes
 * @return IncludeFactory
 */
function factory(){
    return new IncludeFactory();
}
$factory = new IncludeFactory();

/**
 * this function take any number of arguments and includes the files specified
 */
function AllIncludes(){
    $args = func_get_args();
    require_once ("../inclusion/inclusion.php");
    foreach ($args as $item){
        factory()->getInclusion($item)->Inclusion();
    }

}
