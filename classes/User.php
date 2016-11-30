<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-24
 * Time: 01:20 PM
 */
class User
{
    public $firstname ="";
    public $last_name ="";
    public $email ="";
    public $password="";
    public $gender="";

    public function __construct($firstname,$last_name,$email,$password,$gender)
    {
        $this->firstname = $firstname;
        $this->last_name =$last_name;
        $this->email =$email;
        $this->password = $password;
        $this->gender = $gender;
    }

}