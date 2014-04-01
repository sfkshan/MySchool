<?php 

  include "./Library/MySqlEngine.php"; 

    $objDb = new MySQL_Engine();

    global $menu_items;
    
    $menu_items = array(
        (object) array('id'=>'1', 'name'=>'Home', 'parent_menu_id'=>'0'),
        (object) array('id'=>'2', 'name'=>'Products', 'parent_menu_id'=>'0'),
        (object) array('id'=>'3', 'name'=>'About', 'parent_menu_id'=>'0'),
        (object) array('id'=>'4', 'name'=>'Contact', 'parent_menu_id'=>'0'),
        (object) array('id'=>'5', 'name'=>'Apparel', 'parent_menu_id'=>'2'),
        (object) array('id'=>'6', 'name'=>'Shirts', 'parent_menu_id'=>'2'),
        (object) array('id'=>'7', 'name'=>'Pants', 'parent_menu_id'=>'2'),
        (object) array('id'=>'8', 'name'=>'Hats', 'parent_menu_id'=>'5'),
        (object) array('id'=>'9', 'name'=>'Gloves', 'parent_menu_id'=>'5'),
        (object) array('id'=>'10', 'name'=>'Ballcaps', 'parent_menu_id'=>'8'),
        (object) array('id'=>'11', 'name'=>'Beanies', 'parent_menu_id'=>'8'),
        (object) array('id'=>'12', 'name'=>'Wool', 'parent_menu_id'=>'11'),
        (object) array('id'=>'13', 'name'=>'Polyester', 'parent_menu_id'=>'11'),
        (object) array('id'=>'14', 'name'=>'Jimsider.com', 'parent_menu_id'=>'4'),
    );  

    global $menuItems;
    global $parentMenuIds;


    function getMenuResultSet() {
      global $menu_items;
      global $parentMenuIds;
      global $menuItems;

      //create an array of parent_menu_ids to search through and find out if the current items have an children
      foreach($menu_items as $parentId) {
        $parentMenuIds[] = $parentId->parent_menu_id;
      }

      //assign the menu items to the global array to use in the function
      $menuItems = $menu_items;
    }

    //recursive function that prints categories as a nested html unorderd list
    function generate_menu($parent) {
      $has_childs = false;

      //this prevents printing 'ul' if we don't have subcategories for this category
      global $menuItems;
      global $parentMenuIds;

      //use global array variable instead of a local variable to lower stack memory requierment
      foreach($menuItems as $key => $value) {

        if ($value->parent_menu_id == $parent) { 

          //if this is the first child print '<ul>'
          if ($has_childs === false) {
            //don't print '<ul>' multiple times  
            $has_childs = true;
            if($parent != 0) {
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
        generate_menu($value->id);       
        echo '</li>';
      }
    }
    if ($has_childs === true) echo '</ul>';
  }                
?>