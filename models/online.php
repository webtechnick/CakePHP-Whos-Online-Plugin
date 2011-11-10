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
  $stringIp = $_SERVER['REMOTE_ADDR'];
	$intIp = ip2long($stringIp);

	// Making an API call to Hostip:
	$xml = file_get_contents('http://api.hostip.info/?ip='.$stringIp);
	
	$city = $this->get_tag('gml:name',$xml);
	$city = $city[1];
	if($this->is_bot()) {$city = $city."<br>".$this->is_bot();};
	
	$countryName = $this->get_tag('countryName',$xml);
	$countryName = $countryName[0];
	
	$countryAbbrev = $this->get_tag('countryAbbrev',$xml);
	$countryAbbrev = $countryAbbrev[0];
	
	$countryName = str_replace('(Unknown Country?)','UNKNOWN',$countryName);
	if (!$countryName)
	{
		$countryName='UNKNOWN';
		$countryAbbrev='XX';
		$city='(Unknown City?)';
	}

	$this->Create();

    
    $save_data = array(
    'ip'  => $this->_ipAddressToNumber($_SERVER['REMOTE_ADDR']),
    'city' => $city,
	  'country' => $countryName,
	  'countrycode' => $countryAbbrev,
    'url' => $url,
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

  function get_tag($tag,$xml){
  preg_match_all('/<'.$tag.'>(.*)<\/'.$tag.'>$/imU',$xml,$match);
	return $match[1];
  }

	function is_bot(){
		/* This function will check whether the visitor is a search engine robot */
		
		$botlist = array("Teoma", "alexa", "froogle", "Gigabot", "inktomi",
		"looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory",
		"Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot",
		"crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp",
		"msnbot", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz",
		"Baiduspider", "Feedfetcher-Google", "TechnoratiSnoop", "Rankivabot",
		"Mediapartners-Google", "Sogou web spider", "WebAlta Crawler","TweetmemeBot",
		"Butterfly","Twitturls","Me.dium","Twiceler");
	
		foreach($botlist as $bot)
		{
			if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)!==false)
			return $bot;	// Is a bot
		}
	
		return false;	// Not a bot
	}


}
