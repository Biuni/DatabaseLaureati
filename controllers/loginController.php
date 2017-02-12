<?php
  class LoginController {

    public function studenti() {
      //$first_name = 'Gianluca';
      //$last_name  = 'Bonifazi';
      require_once('views/login/studenti.php');
    }

    public function aziende() {
      require_once('views/login/aziende.php');
    }

    public function riservata() {
      //echo $_POST['pass'];
      require_once('views/login/riservata.php');
    }

  }
?>