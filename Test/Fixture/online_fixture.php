<?php 
class OnlineFixture extends CakeTestFixture {
	var $name = 'Online';
	var $table = 'onlines';
	var $import = array('table' => 'onlines', 'import' => false);
	var $records = array(array(
    'ip'  => 123456789,
    'url'  => '/home',
    'modified' => '2009-11-30 15:25:04'
  ));
}
?>