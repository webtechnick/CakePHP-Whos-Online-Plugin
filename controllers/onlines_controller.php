<?php
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
