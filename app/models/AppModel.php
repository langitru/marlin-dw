<?php


namespace Models;

// use RedBeanPHP\SimpleModel;
use RedBeanPHP\R;
use Config\Config;

class AppModel //extends SimpleModel
{
   
   public function __construct()
   {

        R::setup( Config::getDB(), Config::getUser(), Config::getPWD() ); 
        // $users = R::load( 'users', '2' ); 
        // var_dump($users); die; 
       
   }
   
   public function getOne($id)
   {
        // R::setup( Config::getDB(), Config::getUser(), Config::getPWD() ); 
        $users = R::load( 'users', $id ); 
        // $users->username;
        var_dump($users->username); die; 
   }

   public function getAll($table)   
   {
        $users_all  = R::getAll("SELECT * FROM $table");
        return $users_all;
   }
   
   
   
}
