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

			<h3>Newsletter</h3>
			<p class="lead">Gestione della newsletter del corso di laurea.</p><br>

			<!-- Result -->
			<div class="mb-3 text-right <?php echo $hide_ok_view; ?>">
				<div class="alert alert-info" role="alert">
					<strong class="float-left pt-2">Email estratte!</strong>
					<button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					    Vedi Risultati
					</button>
				</div>
				<div class="collapse mt-3 text-left" id="collapseExample">
				  <div class="card card-block">
					<?php
				        foreach ($email_data as $key) {
				        	echo (isset($key['e_mail'])) ? $key['e_mail'].', ' : '';
				        	echo (isset($key['email'])) ? $key['email'].', ' : '';
				        	
				        	if ($key === end($email_data)){
				        		echo (isset($key['e_mail'])) ? $key['e_mail'] : '';
				        		echo (isset($key['email'])) ? $key['email'] : '';
				        	}
				        }
					?>
				  </div>
				</div>
			</div>
			<div class="mb-3 text-right <?php echo $hide_ok_dw; ?>">
				<div class="alert alert-info" role="alert">
					<strong class="float-left pt-2">CSV creato!</strong>
					<a class="btn btn-warning" style="color:#fff" href="<?php echo APP_URL.'/assets/files/newsletter.csv'; ?>">
					    Download CSV
					</a>
				</div>
			</div>

			<!-- Form -->
			<div class="row">
				<div class="col-md-6">
				<p class="text-left"><strong>Laureati</strong></p>

				<form action="<?php echo APP_URL; ?>/admin/newsletter" method="post">

				  <!-- Input per capire che si tratta delle aziende -->
				  <input type="hidden" name="tipo_query" value="0">

					<div class="form-group button-log">
						<button type="submit" class="btn btn-warning">Tutte le mail</button>
					</div>

				</form>

				<hr>

				<form action="<?php echo APP_URL; ?>/admin/newsletter" method="post">

				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Nome</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Nome_Si" name="Nome" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Nome_No" name="Nome" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Cognome</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Cognome_Si" name="Cognome" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Cognome_No" name="Cognome" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Matricola</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Matricola_Si" name="Matricola" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Matricola_No" name="Matricola" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Codice Fiscale</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="CF_Si" name="CF" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="CF_No" name="CF" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Sesso</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Sesso_Si" name="Sesso" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Sesso_No" name="Sesso" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Data di Nascita</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Data_n_Si" name="Data_n" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Data_n_No" name="Data_n" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Luogo di Nascita</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Luogo_n_Si" name="Luogo_n" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Luogo_n_No" name="Luogo_n" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Prov di Nascita</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Prov_n_Si" name="Prov_n" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Prov_n_No" name="Prov_n" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Luogo di Residenza</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Luogo_r_Si" name="Luogo_r" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Luogo_r_No" name="Luogo_r" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Prov di Residenza</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Prov_r_Si" name="Prov_r" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Prov_r_No" name="Prov_r" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Telefono</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Telefono_Si" name="Telefono" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Telefono_No" name="Telefono" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Mail</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="e_mail_Si" name="e_mail" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="e_mail_No" name="e_mail" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Titolo Tesi</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Titolo_tesi_Si" name="Titolo_tesi" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Titolo_tesi_No" name="Titolo_tesi" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Tipologia</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="tipologia_Si" name="tipologia" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="tipologia_No" name="tipologia" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Voto di Laurea</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Voto_laurea_Si" name="Voto_laurea" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Voto_laurea_No" name="Voto_laurea" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Cum Laude</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="cum_laude_Si" name="cum_laude" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="cum_laude_No" name="cum_laude" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Data Laurea</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Data_Laurea_Si" name="Data_Laurea" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Data_Laurea_No" name="Data_Laurea" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Visibilità</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Visibility_Si" name="Visibility" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Visibility_No" name="Visibility" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Note</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Note_Si" name="Note" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Note_No" name="Note" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Relatore</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="relatore_Si" name="relatore" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="relatore_No" name="relatore" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Curriculum Corso</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="curriculum_Si" name="curriculum" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="curriculum_No" name="curriculum" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Download Curriculum</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="CV_download_Si" name="CV_download" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="CV_download_No" name="CV_download" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="Nome" class="col-sm-2 col-form-label">Download Tesi</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="Tesi_download_Si" name="Tesi_download" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="Tesi_download_No" name="Tesi_download" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>

				  <!-- Input per capire che si tratta degli studenti -->
				  <input type="hidden" name="tipo_query" value="1">

					<div class="form-group button-log">
						<button type="submit" class="btn btn-warning">Crea CSV</button>
					</div>

				</form><br>

			</div>

			<div class="col-md-6">
				<p class="text-left"><strong>Aziende</strong></p>

				<form action="<?php echo APP_URL; ?>/admin/newsletter" method="post">

				  <!-- Input per capire che si tratta delle aziende -->
				  <input type="hidden" name="tipo_query" value="2">

					<div class="form-group button-log">
						<button type="submit" class="btn btn-warning">Tutte le mail</button>
					</div>

				</form>

				<hr>

				<form action="<?php echo APP_URL; ?>/admin/newsletter" method="post">

				  <div class="form-group row">
				    <label for="r_sociale" class="col-sm-2 col-form-label">Ragione Sociale</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="r_sociale_Si" name="r_sociale" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="r_sociale_No" name="r_sociale" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="nome" class="col-sm-2 col-form-label">Nome</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="nome_Si" name="nome" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="nome_No" name="nome" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="cognome" class="col-sm-2 col-form-label">Cognome</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="cognome_Si" name="cognome" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="cognome_No" name="cognome" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="email" class="col-sm-2 col-form-label">Mail</label>
				    <div class="col-sm-10">
						<label class="custom-control custom-radio">
						  <input id="email_Si" name="email" type="radio" class="custom-control-input" value="Si" checked>
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Si</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="email_No" name="email" type="radio" class="custom-control-input" value="No">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
				    </div>
				  </div>

				  <!-- Input per capire che si tratta delle aziende -->
				  <input type="hidden" name="tipo_query" value="3">

					<div class="form-group button-log">
						<button type="submit" class="btn btn-warning">Crea CSV</button>
					</div>

				</form><br>
			</div>

		</div>

		</div>

	</main>