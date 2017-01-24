<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-23
 * Time: 02:17 PM
 */

require_once ("../inclusion/inclusion.php");

class ErrorSuccess implements IncludeStatement
{
    private $error = array();
    private $success = array();

    public function Inclusion()
    {
        require_once ('../classes/ErrorSuccess.php');
    }

    /**
     * for error printing
     * surrounds error in reponsive div tags
     * @param $content
     * @param $number| 1-12
     * @return string
     */
    private function concat_with_DIVTag($content,$number){
        return '<div class="colm-'.$number.'" >'.$content.'</div>';
    }

    public function addTOErrorArray($content,$number){
        $this->error[] =  $this->concat_with_DIVTag($content,$number);
    }

    public function addToSuccessArray ($content,$number){
        $this->success[] = $this->concat_with_DIVTag($content,$number);
    }

    public function addError(){
        if ($this->error):
            $_SESSION["error"] = $this->error;
        endif;
    }

    public function addSuccess(){
        if($this->success):
             $_SESSION["success"] = $this->success;
        endif;
    }

    public function getError(){
        return $this->error;
    }

    public function getSuccess(){
        return $this->success;
    }
}