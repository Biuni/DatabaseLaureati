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

		<form>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Username attuale</label>
		    <div class="col-sm-10">
		      <p class="form-control-static"><strong><?php echo $username; ?></strong></p>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="inputPassword" class="col-sm-2 col-form-label">Nuovo Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="inputPassword">
			  <small class="form-text text-muted">Inserisci qui il nuovo username. Può avere una lunghezza massima di 30 caratteri.</small>
		    </div>
		  </div>

			<div class="form-group button-log">
				<button type="submit" class="btn btn-warning">Modifica Username</button>
			</div>
		</form>
		  <hr />

		<form>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Password attuale</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword">
			  <small class="form-text text-muted">Inserisci qui la password attuale.</small>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Nuova password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword">
			  <small class="form-text text-muted">Inserisci la nuova password.</small>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label class="col-sm-2 col-form-label">Ripeti password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword">
			  <small class="form-text text-muted">Ripeti la nuova password.</small>
		    </div>
		  </div>

			<div class="form-group button-log">
				<button type="submit" class="btn btn-warning">Modifica Password</button>
			</div>
		</form><br>

	</main>