<?php
/**
* Online Helper
*
* Used to retrieve the currently online users from the online plugin
*
* @copyright    Copyright 2009, Webtechnick
* @link         http://www.webtechnick.com
* @author       Nick Baker
* @version      1.1
* @license      MIT
*/
class OnlineHelper extends AppHelper {
  
  /** Returns an associative cakePHP array of all currently online users
    * 
    * @return array cakePHP associative array of all online users
    */
  function all(){
    //App::import('Model', 'Online.Online');
    return ClassRegistry::init('Online')->find('all');
  }
  
}
?>
