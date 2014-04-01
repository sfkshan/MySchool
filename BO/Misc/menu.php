<?php
  
  /**
    * @version V 1.0
    * @author "sfk"
    * @link Reference :-
    *                      http://www.jimsider.com/twitter-bootstrap-infinite-menu-php/
    * Gets the data from the MySql tblMenu
    * Generates the html with bootstrap classes ready to serve for menu   
    * source taken from that link
  **/
  include_once "./Library/MySqlEngine.php"; 

  /**
    * @access public
    * Object of data engine
  **/
  global $objDb;
  $objDb = new MySQL_Engine();
  
  /**
    * @access public 
    * use global array variable instead of a local variable to lower stack memory requierment
    * @var $menuItems has the menu items from Databse
    * @var $parentMenuIds has the "Id" of all menus which has children
    *                     means all parent Id are cached in this variable.
  **/
  global $menuItems;
  global $parentMenuIds;

  /**
    * @access public
    * Description :-
    *               This function with all the menu items from the MySql Table "tblMenu" and 
    *               store in the variable $menuItems and all parent Id (who has children) is
    *               stored in the variable $parentMenuIds
    * Caller :-
    *               Is called in the home page "home.php"
  **/
  function getMenuResultSet()
  {
    global $menuItems;
    global $parentMenuIds;
    global $objDb;

    $strSql = "SELECT * FROM tblMenu ORDER BY Menu_intId";
    
    if(!($objDb->blnGetResultSet($strSql))){
        return;
    }
    //Stores all the rows from tblMenu into $menuItems
    while ($objDb->blnResultsMoveNextRow()) {
      $menuItems[] = (object) array(
                        'id'              =>  $objDb->objResultsValue('Menu_intId'), 
                        'name'            =>  $objDb->objResultsValue('Menu_strName'),
                        'parent_menu_id'  =>  $objDb->objResultsValue('Menu_intParentId'),
                        'link'            =>  $objDb->objResultsValue('Menu_strLink')
      );
      //Separating Menu_intParentId into $parentMenuIds
      foreach($menuItems as $parentId) {
        $parentMenuIds[] = $parentId->parent_menu_id;
      }
    }   
  }

  /**
    * @access public
    * @return string HTML string
    * @param  int    $parentId => parentId from which we need to build menu
    * Description :-
    *                 Recursive function which uses the data from MySql 
    *                 (stored in $menuItems and $parentMenuIds)
    *                 builds the HTML String for menu with bootstrap classes
    * Caller      :-
    *                 Is Called in the home page "home.php"
  **/
  function generateMenu($parentId)
  {
    $has_childs = false;

    //this prevents printing 'ul' if we don't have subcategories for this category
    global $menuItems;
    global $parentMenuIds;

    //use global array variable instead of a local variable to lower stack memory requierment
    foreach($menuItems as $key => $value) {

      if ($value->parent_menu_id == $parentId) { 

        //if this is the first child print '<ul>'
        if ($has_childs === false) {
          //don't print '<ul>' multiple times  
          $has_childs = true;
          if($parentId != 0) {
            echo '<ul class="dropdown-menu">';
          }
        }
          
      if($value->parent_menu_id == 0 && in_array($value->id, $parentMenuIds)) {
        echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $value->name . '<b class="caret"></b></a>';
      }
      else if($value->parent_menu_id != 0 && in_array($value->id, $parentMenuIds)) {
        echo '<li class="dropdown-submenu"><a href="#">' . $value->name . '</a>';
      }
      else {
        echo '<li><a href="#">' . $value->name . '</a>';
      }

      //call function again to generate nested list for subcategories belonging to this category
      generateMenu($value->id);       
      echo '</li>';
    }
  }
  if ($has_childs === true) echo '</ul>';
  }

?>