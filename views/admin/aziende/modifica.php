<!-- Corpo centrale del sito -->
	<main id="areariservata">

		<div class="logged-menu">
			<div class="container">
				<div class="float-right">
					<i class="fa fa-user-circle" aria-hidden="true"></i> <a href="<?php echo APP_URL; ?>/admin/"><strong><?php echo $username; ?></strong></a> | <a href="<?php echo APP_URL; ?>/admin/impostazioni">Impostazioni</a> | <a href="<?php echo APP_URL; ?>/admin/logout">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<div class="text-center mt-4 mb-4">
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/"><i class="fa fa-bar-chart" aria-hidden="true"></i> Statistiche</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Laureati</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati/ricerca/"><i class="fa fa-search" aria-hidden="true"></i> Cerca Laureati</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/laureati/inserimento/"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuovo Laureato</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/aziende"><i class="fa fa-building-o" aria-hidden="true"></i> Aziende</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/newsletter"><i class="fa fa-envelope-o" aria-hidden="true"></i> Newsletter</a>
				<a class="btn btn-outline-warning m-1" href="<?php echo APP_URL; ?>/admin/curriculum"><i class="fa fa-file-text" aria-hidden="true"></i> Curriculum</a>
			</div>

			<h3>Modifica Azienda</h3>
			<p class="lead">Modifica dei dati dell'azienda registrata.</p>

			<form action="<?php echo APP_URL; ?>/admin/aziende/modifica/<?php echo $query; ?>/" method="post" id="mod-dati-aziende">

				<div class="alert alert-success <?php echo $hide_ok_azienda; ?>" role="alert">
				  <strong>Dati modificati!</strong> I dati dell'azienda sono stati correttamente modificati.
				</div>
				<div class="alert alert-danger <?php echo $hide_err_azienda; ?>" role="alert">
				  <strong>Attenzione!</strong> La modifica dei dati non è andata a buon fine. L'username potrebbe essere già in uso.
				</div>

				<div class="form-group row">
					<label for="r_sociale" class="col-sm-2 col-form-label">Ragione Sociale</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-danger" id="r_sociale" name="r_sociale" value="<?php echo $azienda->r_sociale; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="nome" class="col-sm-2 col-form-label">Nome Referente</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-danger" id="nome" name="nome" value="<?php echo $azienda->nome; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="cognome" class="col-sm-2 col-form-label">Cognome Referente</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-danger" id="cognome" name="cognome" value="<?php echo $azienda->cognome; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email Referente</label>
					<div class="col-sm-10">
						<input type="email" class="form-control form-control-danger" id="email" name="email" value="<?php echo $azienda->email; ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="username" class="col-sm-2 col-form-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-danger" id="username" name="username" value="<?php echo $azienda->username; ?>">
					</div>
				</div>

				  <div class="form-group row">
				    <label for="newsletter" class="col-sm-2 col-form-label">Newsletter</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="newsletter" name="newsletter" type="radio" class="custom-control-input" value="Si" <?php echo ($azienda->newsletter == 'Si')? 'checked="true"':''; ?>>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si <i class="fa fa-check" aria-hidden="true"></i></span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="newsletter" name="newsletter" type="radio" class="custom-control-input" value="No" <?php echo ($azienda->newsletter == 'No')? 'checked="true"':''; ?>>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No <i class="fa fa-times" aria-hidden="true"></i></span>
						</label>
				    </div>
				  </div>

				<div class="form-group button-log">
					<button type="submit" class="btn btn-warning">Aggiorna Dati</button>
				</div>
			</form><br>

		</div>

	</main>