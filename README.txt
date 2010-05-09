Online CakePHP Plugin
======================
Keeps track of users visiting your site, tracking where they are in
your application.  This will use the user's IP address (converted to a database friendly int).

About
======================
Author Nick Baker
Version 1.2
Link http://www.webtechnick.com
Email nick@webtechnick.com

Get it
======================
Download: http://projects.webtechnick.com/online.tar.gz
SVN: http://svn.github.com/webtechnick/CakePHP-Whos-Online-Plugin
GIT: git@github.com:webtechnick/CakePHP-Whos-Online-Plugin.git 

Changelog:
======================
  1.2: Added nicer included element.
  1.1: Added tests.
  1.0: Initial Release


Setup:
======================
 1) Copy /online into app/plugins/online
 
 2a) Run the online.sql into your database
 2b) Run cake schema run create -path plugins/online/config/sql -name online
   note: If you choose the cake schema route -- I suggest changing your database engine
   to MEMORY as it will be faster to access/write than default.
   note2: if you choose the cake schema route -- change the ip column to 'unsigned' 
 
 3) Add a bit of code to your app_controller.php
  
//app_controller.php
var $uses = array('Online.Online');

function beforeRender(){
  $this->Online->update($this->here);
}


See Who's Online:
======================
  I've included a few ways for you to view who's online without too much hassle.

1) Use the built in OnlineHelper:

  <?php 
  $users_online = $online->all();
  echo debug($users_online);
  ?>
  
2) Use requestAction():

  <?php 
  $users_online = $this->requestAction('/online/onlines');
  echo debug($users_online);
  ?>
  
3) Or you can use the built in element (css will be needed to make it look nice)

  <?php echo $this->element('online', array('plugin' => 'online')); ?>
  
  
Enjoy!
Nick
