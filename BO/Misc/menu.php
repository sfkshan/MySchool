<?php
 	
 	/**
		* @version V 1.0
		* @author "sfk"
		* @link Reference :-
		*											 http://www.jimsider.com/twitter-bootstrap-infinite-menu-php/
		* Gets the data from the MySql tblMenu
		* Generates the html with bootstrap classes ready to serve for menu		
		* source taken from that link
 	**/
 	include_once "./Library/MySqlEngine.php"; 

 	/**
 		* @access private
 		* Object of data engine
 	**/
 	$objDb = new MySQL_Engine();
 	
 	/**
 	  * @access public 
 	  * use global array variable instead of a local variable to lower stack memory requierment
 	  *	@var $menuItems has the menu items from Databse
 	  * @var $parentMenuIds has the "Id" of all menus which has children
 	  *											means all parent Id are cached in this variable.
 	**/
 	global $menuItems;
  global $parentMenuIds;

  /**
  	* @access public
  	* Description :-
  	*								It will all the menu items from the MySql Table "tblMenu" and store in the
  	*								variable $menuItems and all parent Id (who has children) is stored in the
  	*								variable $parentMenuIds
  	*	Caller :-
  	*								Is called in the home page "home.php"
  **/
 	function getMenuResultSet(){
 		
 	}

?>