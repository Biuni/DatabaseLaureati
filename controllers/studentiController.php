<?php

class StudentiController {

    public function index() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = htmlspecialchars($_SESSION['studente']);
      } else {
        return Routes::redirectTo('login','studenti');
      }

      $students = Studenti::userData($username);

      require_once('views/studenti/index.php');
    }

    public function impostazioni() {

      // Controllo la sessione
      if (Session::checkSession('studenti')) {
        $username = htmlspecialchars($_SESSION['studente']);
      } else {
        return Routes::redirectTo('login','studenti');
      }

      $students = Studenti::userData($username);

      require_once('views/studenti/impostazioni.php');
    }
    
    // Funzione di logout
    public function logout() {
        unset($_SESSION['studente']);
        return Routes::redirectTo('pages','home');
    }

}

?>