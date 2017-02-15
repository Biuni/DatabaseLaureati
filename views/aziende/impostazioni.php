<!-- Corpo centrale del sito -->
	<main id="areaaziende">

		<div class="logged-menu">
			<div class="container">
				<div class=" float-right">
					<i class="fa fa-building-o" aria-hidden="true"></i> <a href="<?php echo APP_URL; ?>/aziende/"><strong><?php echo $username; ?></strong></a> | <a href="<?php echo APP_URL; ?>/aziende/impostazioni">Impostazioni</a> | <a href="<?php echo APP_URL; ?>/aziende/logout">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<h3>Impostazioni Account</h3>
			<p class="lead">In questa pagina potrai consultare il database dei laureati del corso di laurea in Informatica Applicata. Per effettuare la ricerca ti basterà completare almeno uno dei campi messi a disposizione oppure consultare direttamente la tabella sottostante.</p>

		<form action="" method="post">

			<div class="alert alert-success <?php echo $hide_ok_user; ?>" role="alert">
			  <strong>Username modificato!</strong> Il tuo username è stato modificato correttamente.
			</div>
			<div class="alert alert-danger <?php echo $hide_err_user; ?>" role="alert">
			  <strong>Attenzione!</strong> La modifica dell'username non è andata a buon fine. Riprova più tardi.
			</div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Username attuale</label>
		    <div class="col-sm-10">
		      <p class="form-control-static"><strong><?php echo $username; ?></strong></p>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="new_user_azienda" class="col-sm-2 col-form-label">Nuovo Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="new_user_azienda" name="new_user_azienda" maxlength="30">
		      <input type="hidden" class="form-control" id="old_user_azienda" name="old_user_azienda" value="<?php echo $username; ?>">
			  <small class="form-text text-muted">Deve avere una lunghezza massima di 30 caratteri e deve far uso di soli caratteri alfanumerici.</small>
		    </div>
		  </div>

			<div class="form-group button-log">
				<button type="submit" class="btn btn-warning">Modifica Username</button>
			</div>
		</form>
		  <hr />

		<form action="" method="post">

			<div class="alert alert-success <?php echo $hide_ok_pwd; ?>" role="alert">
			  <strong>Password modificata!</strong> Dal prossimo login utilizzerai questa nuova password per accedere all'area riservata.
			</div>
			<div class="alert alert-danger <?php echo $hide_err_pwd; ?>" role="alert">
			  <strong>Attenzione!</strong> La modifica della password non è andata a buon fine. Assicurati di aver inserito i dati correttamente.
			</div>

		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Password attuale</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="pwd_attuale" name="pwd_attuale">
		      <input type="hidden" id="pwd_username" name="pwd_username" value="<?php echo $username; ?>">
			  <small class="form-text text-muted">Inserisci qui la password attuale.</small>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Nuova password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="pwd_nuova" name="pwd_nuova">
			  <small class="form-text text-muted">Inserisci la nuova password.</small>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Ripeti password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="pwd_nuova2" name="pwd_nuova2">
			  <small class="form-text text-muted">Ripeti la nuova password.</small>
		    </div>
		  </div>

			<div class="form-group button-log">
				<button type="submit" class="btn btn-warning">Modifica Password</button>
			</div>
		</form><br>

	</main>