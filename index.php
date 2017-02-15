<?php
// Richiedo il file con le variabili globali
require_once('config/global.php');
// Richiedo il file di connessione
require_once('config/connection.php');
// Richiedo il file per il controllo delle sessioni
require_once('config/session.php');
// Inizio la sessione
Session::startSession();

// Controllo se è passato in GET il controller e l'action.
if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'pages';
    $action     = 'home';
}

// Richiedo il file con i metadata
require_once('config/metadata.php');
// Richiedo il file del layout base
require_once('views/layout.php');

?>