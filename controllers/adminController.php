<?php
  class AdminController {

    public function index() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }

      require_once('views/admin/index.php');
    }

  }
?>