<?php

// Richiedo il file di connessione
require_once('config/connection.php');

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