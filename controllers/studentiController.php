<?php
  class StudentiController {
    public function index() {
      	// Controllo la sessione
    	/*if(empty($_SESSION['id'])) {
	        // Redirect alla homepage
	        return call('pages','home');
	    }*/

      require_once('views/studenti/index.php');
    }

    public function impostazioni() {
      	// Controllo la sessione
    	/*if(empty($_SESSION['id'])) {
	        // Redirect alla homepage
	        return call('pages','home');
	    }*/

      require_once('views/studenti/impostazioni.php');
    }
  }
?>