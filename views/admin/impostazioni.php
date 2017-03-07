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

			<h3>Impostazioni Account</h3>
			<p class="lead">In questa pagina potrai modificare la password dell'account di amministrazione.</p>

			<form action="<?php echo APP_URL; ?>/admin/impostazioni" method="post" id="mod-pwd-admin">

				<div class="alert alert-success <?php echo $hide_ok_pwd; ?>" role="alert">
				  <strong>Password modificata!</strong> Dal prossimo login utilizzerai questa nuova password per accedere all'area riservata.
				</div>
				<div class="alert alert-danger <?php echo $hide_err_pwd; ?>" role="alert">
				  <strong>Attenzione!</strong> La modifica della password non è andata a buon fine. Assicurati di aver inserito i dati correttamente.
				</div>
				<div class="alert alert-info <?php echo $info_pwd; ?>" role="alert">
				  <strong>Importante!</strong> Stai per modificare i dati di accesso dell'amministratore, assicurati di inserire una password robusta che contenga caratteri maiuscoli, minuscoli e numeri.
				</div>

				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label">Password attuale</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control form-control-danger" id="pwd_attuale" name="pwd_attuale">
					  <small class="form-text text-muted">Inserisci qui la password attuale.</small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label">Nuova password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control form-control-danger" id="pwd_nuova" name="pwd_nuova">
					  <small class="form-text text-muted">Inserisci la nuova password.</small>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label class="col-sm-2 col-form-label">Ripeti password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control form-control-danger" id="pwd_nuova2" name="pwd_nuova2">
					  <small class="form-text text-muted">Ripeti la nuova password.</small>
				    </div>
				  </div>

				<div class="form-group button-log">
					<button type="submit" class="btn btn-warning">Modifica Password</button>
				</div>
			</form><br>

		</div>

	</main>