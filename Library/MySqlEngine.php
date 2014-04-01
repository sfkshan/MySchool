<?php

  /**
   * V 1.0
   * Description :-
   * Class that connects mysql and retrieves data
   * Takes connection prms from DbSettings.php file located in config folder 
  **/

  /**
   * Gets settings related to MySql from the file
  **/
  include_once  "./Config/DbSettings.php";

  /**
   * @access   public
   * @author   sfk
   * @version  1.0 
  **/
	class MySQL_Engine
  {
    /**
     * _conn,_resultSet, _resultSets, _intResultSetPointer, _intRecordPointer all are private variable
     *
     * _conn holds ths mysqli obj for connection
     * _resultSets            =>  has contains the total result sets returned by the multi_query
     * _resultSet             =>  contains oly one result set which is currently being used
     * _intResultSetPointer   =>  pointer (holds number) for the current resultset being processed
     *                             (has value as index of _resultSets array which is currently in use)
     * _intRecordPointer      =>  pointer (holds number) for the current record being processed in
     *                            (has value as index of _resultSet array which is currently in use) 
    **/

		var $_conn;
		var $_resultSet;
		var $_resultSets;		
		var $_intResultSetPointer =  1;
		var $_intRecordPointer    = -1;

    /**
     * @access public
     * @return bool
     * Opens MySql Connection
    **/
		function blnOpenConnection()
    {
			global $CONNECTION_PARAMETERS;			
			$this->_conn = new mysqli($CONNECTION_PARAMETERS["server"], $CONNECTION_PARAMETERS["user"], $CONNECTION_PARAMETERS["password"], $CONNECTION_PARAMETERS["db"]);
			return isset($this->_conn);
		}

    /**
     * @access public
     * @return bool true if executed properly
     * @param string $strQuery the string which is the sql query passed
     * Performs the execution of multi queries sent and stores here locally in $_resultSets and $_resultSet
    **/
		function blnGetResultSet($strQuery)
    {
			if(!$this->blnOpenConnection()) { 
        return false; 
      }

      $blnResult = $this->_conn->multi_query($strQuery);

      if(!$blnResult) { 
        return false;
      }

      do {
        $objResultSet = $this->_conn->store_result();

        while($objRow =  $objResultSet->fetch_array(MYSQLI_ASSOC)) {
            $arrData[] = $objRow;
        }

        $this->_resultSets[] = $arrData;
        $objResultSet->free();
        unset($arrData);
      } while(($this->_conn->more_results()) && ($this->_conn->next_result()));

      $this->blnCloseConnection();

      if(count($this->_resultSets) > 0) {
          $this->_resultSet = $this->_resultSets[0];
      } else { 
        return false; 
      }

      $this->_intRecordPointer = -1;
      $this-> _intResultSetPointer = 1;
      return true;
		}	

    /**
     * @access public
     * @return bool if closses properly
     * Closes the MySchool connection
    **/
	  function blnCloseConnection() 
    {
	    return $this->_conn->close();
	  }	

    /**
     * @access public
     * @return bool true if next resultset is avail
     * Increments the _intResultSetPointer and puts the next resultset int _resultSet
    **/
	  function blnMoveNextResultSet() 
    {	      		 		  	
	  	if($this-> _intResultSetPointer >= count($this->_resultSets)) { 
        return false; 
      }	

	  	$this->_resultSet = $this->_resultSets[$this->_intResultSetPointer] ;
      $this->_intRecordPointer = -1;
      $this-> _intResultSetPointer ++;

      return true;
	  }

    /**
     * @access public
     * @return bool true if it has more resultsets
    **/
	  function blnMoreResult() 
    {
		 if($this-> _intResultSetPointer < count($this->_resultSets)) {
	      return true;
     }
	   else {
	      return false;
     }
	  }

    /**
      * @access public
      * @return bool true if it has more records in the current resultset
      * Checks the current resultset has rows in further and 
      * Increments the _intRecordPointer 
    **/
    function blnResultsMoveNextRow() 
    {
	    if($this->_intRecordPointer < (count($this->_resultSet) - 1)) { 
        $this->_intRecordPointer++; 
        return true;
      }
        return false;
    }

    /**
      * @access public
      * @return MySql value for the current row of column (column name passed)
      * @param string $strCordinal is the column name required to get
    **/
    function objResultsValue($strCordinal) 
    {
      if(is_numeric($strCordinal)) { 
        $strCordinal = $this->strResultsColName($strCordinal); 
      }

      return $this->_resultSet[$this->_intRecordPointer][$strCordinal];
    }

    /**
      * @access public 
      * @return Current row from MySql from _resultSet
    **/
    function objGetCurrentRow() 
    {
      return $this->_resultSet[$this->_intRecordPointer];
    }

    /**
      * @access public
      * @return Column name when index is passed
      * @param int $intCordinal the index of column which we require column name
    **/
 		function strResultsColName($intCordinal) 
    {
      $arrKeys = array_keys($this->_resultSet[$this->_intRecordPointer]);
      return $arrKeys[$intCordinal];
    }

    /**
      * @access public 
      * @return Datatype of a column
      * @param string $Cordinal the column name which we need DataType
    **/
    function strResultType($Cordinal) 
    {
      $objData = $this->objResultsValue($Cordinal);
      return gettype($objData);
    }

    /**
      * @access public
      * @return the count of the current resultset
    **/
    function lngResultsCount() 
    {
      return count($this->_resultSet);
    }

    /**
      * @access public 
      * @return the number fo the columns
    **/
    function lngResultsNumCols() 
    {
      if(count($this->_resultSet[0]) > 0) {
        return count($this->_resultSet[0]);
      } else { 
        return 0; 
      }
    }

    /**
      * @access public 
      * @return bool true if Query executed succesfully
      * @param string $strQuery is the Sql query needs to executed
      * This function executes the MySql query 
    **/
   	function blnExecute($strQuery) 
    {
		  if(!$this->blnOpenConnection()) { 
        return false; 
      }

		  $blnSuccess = $this->_conn->multi_query($strQuery);

		  if(!$blnSuccess) {
		      //Log errors here
		  }
      
		  $this->blnCloseConnection();
	    return $blnSuccess;
  	}

  	function __destruct() 
    {
    	unset($this->_resultSet);
    	unset($this->_resultSets);
  	}
	}	
?> 
