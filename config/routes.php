<?php

  // Funzione call() utilizzata per
  // gestire le chiamate ai controller
  // e ai loro rispettivi metodi
  function call($controller, $action) {

    // Richiedo il file che corrisponde
    // al nome del Controller
    require_once('controllers/' . $controller . 'Controller.php');

    // Creo una nuova istanza del
    // controllo richiesto
    switch($controller) {
      case 'pages':
        require_once('models/Pages.php');
        $controller = new PagesController();
      break;
      case 'login':
        $controller = new LoginController();
      break;
      case 'registrazione':
        $controller = new RegistrazioneController();
      break;


      case 'aziende':
        require_once('models/Aziende.php');
        $controller = new AziendeController();
      break;
      case 'studenti':
        require_once('models/Studenti.php');
        $controller = new StudentiController();
      break;

      /*case 'posts':
        require_once('models/Post.php');
        $controller = new PostsController();
      break;*/
    }

    // Chiamo il metodo (action)
    // all'interno del controller
    $controller->{ $action }();
  }

  // Lista dei controller e dei
  // metodi considerati validi
  $controllers = array(
    'pages'         => ['home', 'error'],
    'login'         => ['studenti', 'aziende', 'riservata'],
    'registrazione' => ['index','privacy'],
    // Aree private
    'aziende'       => ['index','impostazioni', 'dettaglio'],
    'studenti'      => ['index','impostazioni'],
  );

  // Controllo che il controller e il
  // metodo passato siano entrambi validi
  // per poi invocare la funzione call() con
  // i parametri esatti.
  // Se qualcuno prova ad accedere in modo
  // errato sarà chiamata la funzione
  // call() alla quale sarà passato controller
  // e metodo per stampare errore
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>