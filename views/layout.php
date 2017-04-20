<?php
  // Inizializzo i metadati per il controller 
  // e l'azione corrente
  $metadata = Metadata::getMetadata($controller, $action);
?>

<!DOCTYPE html>
<html lang="<?php echo APP_LANG; ?>">
<head>
  <meta charset="<?php echo APP_CHARSET; ?>">
  
  <!-- Info -->
  <title><?php echo $metadata->title; ?></title>
  <meta name="description" content="<?php echo $metadata->description; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="<?php echo APP_COLOR; ?>">

  <!-- Facebook Share -->
  <meta property="og:title" content="<?php echo $metadata->share_title; ?>" />
  <meta property="og:description" content="<?php echo $metadata->share_desc; ?>" />
  <meta property="og:url" content="<?php echo $metadata->share_url; ?>" />
  <meta property="og:image" content="<?php echo $metadata->share_img; ?>" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo APP_URL; ?>/assets/img/favicon.ico">

  <!-- Stili -->
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/datatable.css">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/mobile.css">

</head>
<body>

  <!-- Testata del sito -->
  <header>
    <!-- Informazioni Generali -->
    <div class="general-info">
      <div class="container">
        <div class="row">
          <!-- Colonna Sinistra -->
          <div class="col-sm-5">
            <div class="float-left info-small">
              <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo APP_MAIL; ?>"><?php echo APP_MAIL; ?></a>
            </div>
          </div>
          <!-- Colonna Destra -->
          <div class="col-sm-7">
            <div class="float-right info-small">
              <ul class="list-inline mb-0">
                <li class="list-inline-item"><a href="https://www.facebook.com/InfoAppl">Facebook</a></li>
                <li class="list-inline-item">| <a href="https://twitter.com/InfoAppl">Twitter</a> |</li>
                <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/login/riservata">Area Riservata</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Menu di Navigazione -->
    <nav>
      <div class="container">
        <div class="row vertical-align menu-row">
          <!-- Logo -->
          <div class="col-sm-3">
            <div class="float-left">
              <a href="<?php echo APP_URL; ?>"><img src="<?php echo APP_URL; ?>/assets/img/logo.png" alt="Logo Uniurb" title="Logo Uniurb" class="logo"></a>
            </div>
          </div>
          <!-- Menu -->
          <div class="col-sm-9">
            <!-- Desktop -->
            <div class="float-right menu-navigation">
              <ul class="list-inline mb-0">
                <li class="list-inline-item"><a href="<?php echo APP_URL; ?>">Homepage</a></li>

                <?php if(!Session::checkSession('studenti')) : ?>
                  <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/login/studenti">Login Studenti</a></li>
                <?php else : ?>
                  <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/studenti/">Area Studenti</a></li>
                <?php endif; ?>

                <?php if(!Session::checkSession('aziende')) : ?>
                  <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/login/aziende">Login Aziende</a></li>
                <?php else : ?>
                  <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/aziende/">Area Aziende</a></li>
                <?php endif; ?>

                <li class="list-inline-item"><a href="<?php echo APP_URL; ?>/registrazione/">Registrazione</a></li>
              </ul>
            </div>
            <!-- Mobile -->
            <div class="float-right menu-navigation-mobile">
              <button type="button" class="btn btn-outline-warning openbtn-sidenav"><i class="fa fa-bars" aria-hidden="true"></i></button>
              <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn-sidenav">&times;</a>
                  <a href="<?php echo APP_URL; ?>">Homepage</a>

                  <?php if(!Session::checkSession('studenti')) : ?>
                    <a href="<?php echo APP_URL; ?>/login/studenti">Login Studenti</a>
                  <?php else : ?>
                    <a href="<?php echo APP_URL; ?>/studenti/">Area Studenti</a>
                  <?php endif; ?>

                  <?php if(!Session::checkSession('aziende')) : ?>
                    <a href="<?php echo APP_URL; ?>/login/aziende">Login Aziende</a>
                  <?php else : ?>
                    <a href="<?php echo APP_URL; ?>/aziende/">Area Aziende</a>
                  <?php endif; ?>

                  <a href="<?php echo APP_URL; ?>/registrazione/">Registrazione</a>
              </div>
              <div class="overlay-sidenav"></div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>


  <!-- Corpo centrale del sito -->
  <?php
    require_once('config/routes.php');
    $routes = new Routes();
    $routes->existsRoute($controller, $action);
  ?>


  <!-- Footer del sito -->
  <footer>
    <div class="container">
      <div class="float-left">&copy; <?php echo date("Y"); ?> STI Footer</div>
      <div class="float-right">Developed by <strong><a href="http://www.biuni.it">Gianluca Bonifazi</a></strong></div>
      <div class="clear"></div>
    </div>
  </footer>

  <!-- Javascript -->
  <script src="<?php echo APP_URL; ?>/assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?php echo APP_URL; ?>/assets/js/tether.min.js"></script>
  <script src="<?php echo APP_URL; ?>/assets/js/bootstrap.min.js"></script>
  <script src="<?php echo APP_URL; ?>/assets/js/jquery.counterup.min.js"></script>
  <script src="<?php echo APP_URL; ?>/assets/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo APP_URL; ?>/assets/js/init.js"></script>

  <?php
  // Inserisco gli script per i grafici solo se sono all'interno
  // dell'area riservata all'amministratore
  if ($controller == 'admin') {
    echo '<script src="'.APP_URL.'/assets/js/Chart.min.js"></script>';
    echo '<script src="'.APP_URL.'/assets/js/Chart.draw.js"></script>';
  }
  ?>
  
</body>
</html>