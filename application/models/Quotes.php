<?php

/**
 * This is a "CMS" model for quotes, but with bogus hard-coded data.
 * This would be considered a "mock database" model.
 *
 * @author jim
 */
class Quotes extends MY_Model {

    // Constructor
    public function __construct() {
        //make model from the RDB table corresponding to tablename and PK field parameters
        //this RDB table can be accessed through this model via methods such as get(), etc.
       parent::__construct('quotes', 'id'); 
    }
    
    // retrieve the most recently added quote
    function last() {
	$key = $this->highest();
	return $this->get($key);
    }
}
