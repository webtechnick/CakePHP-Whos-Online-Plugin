<?php
class onlineSchema extends CakeSchema {
  var $name = 'online';
  
  function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}  
  
  var $onlines = array(
		'ip' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'url' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('ip' => array('column' => 'ip', 'unique' => 1))
	);
}
?>