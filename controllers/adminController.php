<?php
  class AdminController {

    public function index() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }

        $info = Admin::lastLogin();
        $last_seven = [
          date('Y-m-d', strtotime('-6 days')),
          date('Y-m-d', strtotime('-5 days')),
          date('Y-m-d', strtotime('-4 days')),
          date('Y-m-d', strtotime('-3 days')),
          date('Y-m-d', strtotime('-2 days')),
          date('Y-m-d', strtotime('-1 days')),
          date('Y-m-d')
        ];
        $lastLoginAziende = Admin::lastLoginAziende($last_seven);
        $lastLoginStudenti = Admin::lastLoginStudenti($last_seven);
        $votoLaurea = Admin::votoLaurea();

        require_once('views/admin/index.php');
    }



    public function laureati() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Pagine accettate:
        // - modifica
        // - inserimento
        // - ricerca
        // - dettaglio
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina stampo l'index
        if ($pagina){

          $pagina = $_GET['pagina'];

          $allow_page = ['modifica','inserimento','ricerca','dettaglio'];
          // Controllo se la pagina è una di quelle
          // accettate. Se essite entro
          if(in_array($pagina, $allow_page)){

            if ($pagina == 'dettaglio' || $pagina == 'modifica') {
              // Leggo l'id di riferimento
              $query = isset($_GET['query']);
              if ($query) {

                $query = $_GET['query'];
                echo $query;
                require_once('views/admin/laureati/'.$pagina.'.php');

              } else {

                return Routes::redirectTo('admin','laureati');

              }

            } else {

              require_once('views/admin/laureati/'.$pagina.'.php');

            }

          } else {

            return Routes::redirectTo('admin','laureati');

          }

        } else {

          require_once('views/admin/laureati.php');

        }
    }



    public function aziende() {

        // Controllo la sessione
        if (Session::checkSession('admin')) {
          $username = htmlspecialchars($_SESSION['gestore']);
        } else {
          return Routes::redirectTo('login','riservata');
        }
        
        // Pagine accettate:
        // - modifica
        $pagina = isset($_GET['pagina']);
        // Se non è stata passata nessuna pagina stampo l'index
        if ($pagina){

          $pagina = $_GET['pagina'];
          // Controllo se la pagina è una di quelle
          // accettate. Se essite entro
          if($pagina == 'modifica'){

              // Leggo l'id di riferimento
              $query = isset($_GET['query']);
              if ($query) {

                $query = $_GET['query'];
                echo $query;
                require_once('views/admin/aziende/'.$pagina.'.php');

              } else {

                return Routes::redirectTo('admin','aziende');

              }

            }

          } else {

            require_once('views/admin/aziende.php');

          }
    }



    public function curriculum() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      require_once('views/admin/curriculum.php');
    }



    public function impostazioni() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      require_once('views/admin/impostazioni.php');
    }



    public function newsletter() {

      // Controllo la sessione
      if (Session::checkSession('admin')) {
        $username = htmlspecialchars($_SESSION['gestore']);
      } else {
        return Routes::redirectTo('login','riservata');
      }

      require_once('views/admin/newsletter.php');
    }



    public function logout() {
      Session::destroySession();
      return Routes::redirectTo('login','riservata');
    }


  }
?>