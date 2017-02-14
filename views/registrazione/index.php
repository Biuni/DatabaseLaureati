<main id="registrazione">

	<div class="container">
		
		<h3 class="reg-azienda">Registrazione azienda</h3>
		<p class="lead">Per ricevere username e password compilare tutti i campi sottostanti. Le credenziali per l'accesso al database verranno inviate all'indirizzo email riportato. L'iscrizione alla newsletter consente di ricevere periodicamente informazioni sulle nostre iniziative e sugli aggiornamenti del database. La compilazione del form sottintende l'accettazione di quanto riportato nella nota informativa sulla privacy sotto riportata.</p>

		<div class="alert alert-success <?php echo $hide_ok; ?>" role="alert">
		  <strong>Registrazione effettuata!</strong> Stiamo controllando i tuoi dati, riceverai presto una mail con le credenziali di accesso.
		</div>
		<div class="alert alert-danger <?php echo $hide_err; ?>" role="alert">
		  <strong>Attenzione!</strong> La registrazione non è andata a buon fine. Riprova più tardi.
		</div>

		<form method="post" action="#" id="form-reg-azienda">

			<div class="form-group input-ragionesociale">
				<label class="form-control-label" for="ragionesociale">Ragione sociale</label>
				<input type="text" class="form-control form-control-success form-control-danger" id="ragionesociale" name="ragionesociale">
				<small class="form-text text-muted">La ragione sociale viene usata per indicare il nome di una società di persone.</small>
			</div>
			<div class="form-group input-nomereferente">
				<label class="form-control-label" for="nomereferente">Nome</label>
				<input type="text" class="form-control form-control-success form-control-danger" id="nomereferente" name="nomereferente">
				<small class="form-text text-muted">Nome del referente dell'azienda.</small>
			</div>
			<div class="form-group input-cognomereferente">
				<label class="form-control-label" for="cognomereferente">Cognome</label>
				<input type="text" class="form-control form-control-success form-control-danger" id="cognomereferente" name="cognomereferente">
				<small class="form-text text-muted">Cognome del referente dell'azienda.</small>
			</div>
			<div class="form-group input-emailreferente">
				<label class="form-control-label" for="emailreferente">Email</label>
				<input type="text" class="form-control form-control-success form-control-danger" id="emailreferente" name="emailreferente">
				<small class="form-text text-muted">Email del referente dell'azienda.</small>
			</div>

			<div class="form-group input-checkbox">
				<label class="custom-control custom-checkbox privacy-check">
				  <input type="checkbox" class="custom-control-input" name="privacy" checked="true">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Ho letto e accetto l'<u><a href="?controller=registrazione&action=privacy" target="blank">informativa sulla privacy</a></u>.</span>
				</label>
				<label class="custom-control custom-checkbox">
				  <input type="checkbox" class="custom-control-input" name="newsletter" checked="true">
				  <span class="custom-control-indicator"></span>
				  <span class="custom-control-description">Iscriviti alla newsletter.</span>
				</label>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-warning">Invia</button>
			</div>

		</form>

	</div>

</main>