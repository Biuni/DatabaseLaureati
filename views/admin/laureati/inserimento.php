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

			<h3>Inserisci Laureato</h3>
			<p class="lead">Form per l'inserimento di un nuovo studente laureato.</p><br>

			<form action="<?php echo APP_URL; ?>/admin/laureati/inserimento/" method="post" id="inserisci-studente">

				<div class="alert alert-success <?php echo $hide_ok_insert; ?>" role="alert">
				  <strong>Laureato inserito!</strong> I dati del nuovo laureato sono stati correttamente inseriti.
				</div>
				<div class="alert alert-danger <?php echo $hide_err_insert; ?>" role="alert">
				  <strong>Attenzione!</strong> L'inserimento dei dati non è andata a buon fine. Riprova.
				</div>

			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Nome</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Nome" name="Nome" placeholder="Nome">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Cognome</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Cognome" name="Cognome" placeholder="Cognome">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Matricola</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Matricola" name="Matricola" placeholder="Matricola">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="Sesso" class="col-sm-2 col-form-label">Sesso</label>
			    <div class="col-sm-10">
					<label class="custom-control custom-radio">
					  <input id="Sesso_M" name="Sesso" type="radio" class="custom-control-input" value="M">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">M</span>
					</label>
					<label class="custom-control custom-radio">
					  <input id="Sesso_F" name="Sesso" type="radio" class="custom-control-input" value="F">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">F</span>
					</label>
			    </div>
			  </div>
			  <div class="form-group row input_e_mail">
			    <label for="e_mail" class="col-sm-2 col-form-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control form-control-danger" id="e_mail" name="e_mail" placeholder="Email">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Curriculum</label>
			    <div class="col-sm-10">
			    	<select class="form-control" id="curriculum" name="curriculum">
						<option value="">Scegli...</option>
						<?php 
							foreach($curriculum as $cv) {
								$selected_ok = (strtolower($students->curriculum) == strtolower($cv['nome']))? 'selected' : '';
								echo '<option value="'.$cv['nome'].'" '.$selected_ok.'>'.$cv['nome'].'</option>';
							}
						?>
			    	</select>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Titolo tesi</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Titolo_tesi" name="Titolo_tesi" placeholder="Titolo tesi">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Tipologia</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="tipologia" name="tipologia" placeholder="Tipologia">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Relatore</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="relatore" name="relatore" placeholder="Relatore">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Voto Laurea</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Voto_laurea" name="Voto_laurea" placeholder="Voto Laurea">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="cum_laude" class="col-sm-2 col-form-label">Cum Laude</label>
			    <div class="col-sm-10">
					<label class="custom-control custom-radio">
					  <input id="cum_laude" name="cum_laude" type="radio" class="custom-control-input" value="si">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Si <i class="fa fa-check" aria-hidden="true"></i></span>
					</label>
					<label class="custom-control custom-radio">
					  <input id="cum_laude2" name="cum_laude" type="radio" class="custom-control-input" value="no">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">No <i class="fa fa-times" aria-hidden="true"></i></span>
					</label>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Data di Laurea</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control form-control-danger" id="Data_Laurea" name="Data_Laurea" placeholder="Data di Laurea">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="Visibility" class="col-sm-2 col-form-label">Visibilità</label>
			    <div class="col-sm-10">
					<label class="custom-control custom-radio">
					  <input id="Visibility" name="Visibility" type="radio" class="custom-control-input" value="1">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Visibile <i class="fa fa-check" aria-hidden="true"></i></span>
					</label>
					<label class="custom-control custom-radio">
					  <input id="Visibility2" name="Visibility" type="radio" class="custom-control-input" value="0">
					  <span class="custom-control-indicator"></span>
					  <span class="custom-control-description">Nascosto <i class="fa fa-times" aria-hidden="true"></i></span>
					</label>
			    </div>
			  </div>
			  <hr>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control form-control-danger" id="Password" name="Password" placeholder="Password">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label class="col-sm-2 col-form-label">Ripeti Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control form-control-danger" id="Password" name="Password2" placeholder="Ripeti password">
			    </div>
			  </div>

				<div class="form-group button-log">
					<button type="submit" class="btn btn-warning">Inserisci Dati</button>
				</div>
			</form><br>

		</div>

	</main>