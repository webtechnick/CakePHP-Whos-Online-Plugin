<?php
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
    * @return MySQL datetime stamp of ten minutes ago.
    */
  function _tenMinAgo(){
    $tenMin = 10*60;
    return date("Y-m-d H:i:s", time() - $tenMin);
  }
  
  /**
    * converts an IP address to a number for the database.
    *
    * @param $IPaddress string to convert to an int
    * @return int of converted IPaddress.
    */
  function _ipAddressToNumber($IPaddress = null){
    $retval = 0;
    if(!empty($IPaddress)){ 
      $ips = split ("\.", "$IPaddress"); 
      $retval = ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256); 
    }
    return $retval;
  } 
}
