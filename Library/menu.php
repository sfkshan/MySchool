<?php
	
	include "./Library/DbEngine.php"; 	

	class Menu {
  	
  	var $objDb;
  	var $parentMenuIds;
  	var $menuItems;
    var $menuData;

  	function __construct(){
  		$this->objDb = new clsDBEngine();            
  	}

  	function getMenuResultSets(){
			$strSql = "SELECT * FROM tblMenu ORDER BY Menu_intId";
  		if(!($this->objDb->blnGetResultSet($strSql))){
  			return;
  		}
  		while ($this->objDb->blnResultsMoveNextRow()) {
 			  $this->menuData[] = (object) array(
                          'id'=>$this->objDb->objResultsValue('Menu_intId'), 
                          'name'=>$this->objDb->objResultsValue('Menu_strName'),
                          'parent_menu_id'=>$this->objDb->objResultsValue('Menu_intParentId'),
                          'link'=>$this->objDb->objResultsValue('Menu_strLink'));     	
  		}
      foreach($this->menuData as $key => $value) {
        $this->parentMenuIds[] = $value->parent_menu_id;
      }
  		$this->menuItems = $this->menuData;
  	}

    //recursive function that prints categories as a nested html unorderd list
    function generateMenu($parent)  {    
      $has_childs = false;
      //use global array variable instead of a local variable to lower stack memory requierment
      foreach($this->menuData as $key => $value) {
        if ($value->parent_menu_id == $parent){    
            //if this is the first child print '<ul>'
            if ($has_childs === false){
              //don't print '<ul>' multiple times  
              $has_childs = true;
              if($parent != 0) {
                echo '<ul class="dropdown-menu">';
              }
            }
        }
              
        if($value->parent_menu_id == 0 && in_array($value->id, $this->parentMenuIds)) {
          echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $value->name . '<b class="caret"></b></a>';
        }
        else if($value->parent_menu_id != 0 && in_array($value->id, $this->parentMenuIds)){
          echo '<li class="dropdown-submenu"><a href="#">' . $value->name . '</a>';
        }
        else {
          echo '<li><a href="#">' . $value->name . '</a>';
        }
        $this->generateMenu($value->id);
                
        //call function again to generate nested list for subcategories belonging to this category
        echo '</li>';
       }
      if ($has_childs === true) echo '</ul>';  
  }  
}
?>