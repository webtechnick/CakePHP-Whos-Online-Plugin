<?php
/**
* Online Controller
*
* Tracks users on the site
*
* @copyright    Copyright 2009, Webtechnick
* @link         http://www.webtechnick.com
* @author       Nick Baker
* @version      1.1
* @license      MIT
*/
class OnlinesController extends OnlineAppController{
  
  function index(){
    $onlines = $this->Online->find('all');
    if(isset($this->params['requested'])){
      return $onlines;
    }
    $this->set(compact('onlines'));
  }
}
?>
