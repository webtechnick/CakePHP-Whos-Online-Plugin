<?php
/** Online helper for the Online Plugin
  *
  * @author Nick Baker
  * @link http://www.webtechnick.com
  * @version 1.0
  */
class OnlineHelper extends AppHelper {
  
  function all(){
    //App::import('Model', 'Online.Online');
    return ClassRegistry::init('Online')->find('all');
  }
  
}
?>
