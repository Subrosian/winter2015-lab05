<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
	$this->data['pagebody'] = 'justone';    // this is the view we want shown
	$choice = rand(1,$this->quotes->size());
        $this->data = array_merge($this->data, (array) $this->quotes->get($choice));
        $this->data['average'] = ($this->data['vote_count'] > 0) ?
            ($this->data['vote_total'] / $this->data['vote_count']) : 0;
        $this->caboose->needed('jrating','hollywood');
        
	$this->render();
    }

    // handle a rating
    //This would be done as a separate controller, if done properly.
    function rate() {
      // detect and reject non-AJAX entry
      if (!isset($_POST['action'])) redirect("/");
      
      // extract parameters obtained from widget
      $id = intval($_POST['idBox']);
      $rate = intval($_POST['rate']);
      
      // update the corresponding entry's rating
      $record = $this->quotes->get($id);
      if ($record != null) {
        $record->vote_total += $rate;
        $record->vote_count++;
        $this->quotes->update($record);
      }
      $response = 'Thanks for voting!';
      echo json_encode($response);
    }
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */