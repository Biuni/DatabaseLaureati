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

			<h3>Dettaglio Studente</h3>
			<p class="lead">Dettaglio dello studente laureato.</p>

					<div class="timeline">

						<div class="time-box">
							<div class="time-data">
								Nome
							</div>
							<div class="time-description">
								<strong><?php echo $students->Nome; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Cognome
							</div>
							<div class="time-description">
								<strong><?php echo $students->Cognome; ?></strong>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data di nascita
							</div>
							<div class="time-description">
                				<?php if($students->Data_n != '0000-00-00') : ?>
								<strong><?php echo $students->Data_n; ?></strong>
				                <?php else : ?>
				                  <i>Non ancora inserita</i>
				                <?php endif; ?>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Matricola
							</div>
							<div class="time-description">
								<strong><?php echo $students->Matricola; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Sesso
							</div>
							<div class="time-description">
								<strong><?php echo $students->Sesso; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Codice Fiscale
							</div>
							<div class="time-description">
                				<?php if($students->CF != '') : ?>
								<strong><?php echo $students->CF; ?></strong>	
				                <?php else : ?>
				                  <i>Non ancora inserito</i>
				                <?php endif; ?>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Luogo di Nascita
							</div>
							<div class="time-description">
                				<?php if($students->Luogo_n != '') : ?>
								<strong><?php echo $students->Luogo_n; ?> <?php echo ($students->Prov_n)? "(".$students->Prov_n.")" : ""; ?></strong>	
				                <?php else : ?>
				                  <i>Non ancora inserito</i>
				                <?php endif; ?>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Comune di residenza
							</div>
							<div class="time-description">
                				<?php if($students->Luogo_r != '') : ?>
								<strong><?php echo $students->Luogo_r; ?> <?php echo ($students->Prov_r)? "(".$students->Prov_r.")" : ""; ?></strong>	
				                <?php else : ?>
				                  <i>Non ancora inserito</i>
				                <?php endif; ?>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Telefono
							</div>
							<div class="time-description">
                				<?php if($students->Telefono != '') : ?>
								<strong><?php echo $students->Telefono; ?></strong>		
				                <?php else : ?>
				                  <i>Non ancora inserito</i>
				                <?php endif; ?>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Email
							</div>
							<div class="time-description">
								<strong><?php echo $students->e_mail; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Curriculum
							</div>
							<div class="time-description">
								<strong><?php echo $students->curriculum; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Titolo tesi
							</div>
							<div class="time-description">
								<strong><?php echo $students->Titolo_tesi; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Tipologia
							</div>
							<div class="time-description">
								<strong><?php echo $students->tipologia; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Relatore
							</div>
							<div class="time-description">
								<strong><?php echo $students->relatore; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Voto Laurea
							</div>
							<div class="time-description">
								<strong><?php echo $students->Voto_laurea; echo ($students->cum_laude == 'si')? " e lode" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data Laurea
							</div>
							<div class="time-description">
								<strong><?php echo $students->Data_Laurea; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Visibilità
							</div>
							<div class="time-description">
								<strong>
								<?php echo ($students->Visibility == 1)? '<i class="fa fa-check" aria-hidden="true"></i> (visibile)' : '<i class="fa fa-times" aria-hidden="true"></i> (nascosto)'?>
								</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Download Curriculum
							</div>
							<div class="time-description">
                				<?php if($students->CV_download != '') : ?>
								<?php echo '<a href="'.APP_URL.'/assets/files/cv/'.$students->CV_download.'" class="view-more-student btn btn-warning" target="blank">Scarica Curriculum</a>'; ?>	
				                <?php else : ?>
				                  <i>Non ancora caricato</i>
				                <?php endif; ?>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Download Tesi
							</div>
							<div class="time-description">
                				<?php if($students->Tesi_download != '') : ?>
								<?php echo '<a href="'.APP_URL.'/assets/files/tesi/'.$students->Tesi_download.'" class="view-more-student btn btn-warning" target="blank">Scarica Tesi</a>'; ?>	
				                <?php else : ?>
				                  <i>Tesi non presente</i>
				                <?php endif; ?>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Note
							</div>
							<div class="time-description">
                				<?php if($students->Note != '') : ?>
								<strong><?php echo $students->Note; ?></strong>	
				                <?php else : ?>
				                  <i>Nessuna nota inserita</i>
				                <?php endif; ?>	
							</div>
						</div>
					</div>

				<div class="text-center">
					<a href="<?php echo APP_URL; ?>/admin/laureati/modifica/<?php echo $students->ID; ?>/" class="btn btn-warning view-more-student">Modifica Dati</a>
				</div><br>
		</div>

	</main>