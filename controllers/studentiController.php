<?php
  class StudentiController {
    public function index() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = $_SESSION['studente'];
      } else {
        return call('pages','home');
      }

      require_once('views/studenti/index.php');
    }

    public function impostazioni() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = $_SESSION['studente'];
      } else {
        return call('pages','home');
      }

      require_once('views/studenti/impostazioni.php');
    }
    
    // Funzione di logout
    public function logout() {
        unset($_SESSION['studente']);
        return call('pages','home');
    }
  }
?>