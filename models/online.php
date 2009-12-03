<?php
/**
* Online Model
*
* Tracks users on the site
*
* @copyright    Copyright 2009, Webtechnick
* @link         http://www.webtechnick.com
* @author       Nick Baker
* @version      1.1
* @license      MIT
*/
class Online extends OnlineAppModel {
  var $name = 'Online';
  var $primaryKey = 'ip';
  

  /**
    * Clear the table of old online stats
    * Update the user to the current url
    *
    * @param $url of the user currently accessing the app ($this->here from a controller)
    */
  function update($url = null){
    $this->deleteOld();
    $this->updateUser($url);
  }
  
  /**
    * Clear the table of old online users
    */
  function deleteOld(){
    $conditions = array(
      //'Online.modified < DATE_SUB(CURDATE(), INTERVAL 1 DAY)',
      'Online.modified < ' => $this->_tenMinAgo()
    );
    $this->deleteAll($conditions);
  }
  
  /**
    * Update the user to the current url
    *
    * @param $url of the user currently accessing the app ($this->here from a controller)
    */
  function updateUser($url = null){
    $save_data = array(
      'ip'  => $this->_ipAddressToNumber($_SERVER['REMOTE_ADDR']),
      'url' => $url
    );
    $this->save($save_data);
  }
  
  /**
    * Helper method to give me ten minutes ago non MySQL related
    *
    * @return string MySQL datetime stamp of ten minutes ago.
    */
  function _tenMinAgo(){
    $tenMin = 10*60;
    return date("Y-m-d H:i:s", time() - $tenMin);
  }
  
  /**
    * converts an IP number to an IP address from the database
    * 
    * @param int number to convert to IP address
    * @return String IPaddress
    */
  function _NumberToIpAddress($number = null){
    return long2ip($number);
  }
  
  /**
    * Assigns the real_ip to the returning find results.
    * 
    * @return array of results cakePHP style with 'real_ip' set as a new key
    */
  function afterFind($results){
    foreach($results as $key => $val){
      if(isset($val[$this->alias]['ip'])){
        $results[$key][$this->alias]['real_ip'] = $this->_NumberToIpAddress($val[$this->alias]['ip']);
      }
    }
    return $results;
  }
  
  /**
    * converts an IP address to a number for the database.
    *
    * @param $IPaddress string to convert to an int
    * @return int of converted IPaddress.
    */
  function _ipAddressToNumber($IPaddress = null){
    return ip2long($IPaddress);
  } 
}
