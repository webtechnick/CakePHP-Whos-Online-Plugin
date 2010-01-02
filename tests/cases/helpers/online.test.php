<?php
App::import('Helper','Online.Online');

class OnlineHelperTestCase extends CakeTestCase {
  var $fixtures = array('plugin.online.online');
  
  function setUp(){
    $this->online = new OnlineHelper();
  }
  
  function testAll(){
    $results = $this->online->all();
    $this->assertTrue(!empty($results));
            
    $expected = array('0' => array(
      'Online' => array(
        'ip'  => 123456789,
        'url'  => '/home',
        'modified' => '2009-11-30 15:25:04',
        //'real_ip' => '7.91.205.21'
      )
    ));
		$this->assertEqual($results, $expected);
  }
  
  function tearDown(){
    unset($this->online);
  }
}
?>