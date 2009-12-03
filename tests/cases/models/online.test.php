<?php
App::import('Model','Online.Online');

class OnlineTestCase extends CakeTestCase {
  var $Online = null;
  var $fixtures = array(
    'plugin.online.online'
  );
  
  function startTest(){
    $this->Online = ClassRegistry::init('Online');
    $this->Online->recursive = -1;
  }
  
  function testOnlineInstance(){
    $this->assertTrue(is_a($this->Online,'Online'));
  }
  
  function testOnlineFind() {
		$results = $this->Online->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Online' => array(
			'ip'  => 123456789,
      'url'  => '/home',
      'modified' => '2009-11-30 15:25:04',
      'real_ip' => '7.91.205.21'
	  ));
		$this->assertEqual($results, $expected);
	}
	
	function testUpdateUser(){
	  $_SERVER['REMOTE_ADDR'] = '214.146.48.154';
	  $this->Online->updateUser('/new/path.xml');
	  
	  $results = $this->Online->find('first', array('order' => 'Online.modified DESC'));
	  $this->assertEqual($results['Online']['url'], '/new/path.xml');
	}
	
	function testIpToNumber(){
	  $this->assertEqual($this->Online->_ipAddressToNumber('127.0.0.1'), 2130706433);
	}
	
	function testDeleteOld(){
	  $results = $this->Online->find('first');
	  $this->assertTrue(!empty($results));
	  $this->Online->deleteOld();
	  $results = $this->Online->find('first');
	  $this->assertTrue(empty($results));
	}
	
	function endTest(){
	  ClassRegistry::flush();
	}
  
}
?>