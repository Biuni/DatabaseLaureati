<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<!-- Corpo centrale del sito -->
	<main id="areastudenti">

		<div class="logged-menu">
			<div class="container">
				<div class=" float-right">
					<i class="fa fa-building-o" aria-hidden="true"></i> <strong>Biesse</strong> | <a href="?controller=aziende&action=impostazioni">Impostazioni</a> | <a href="#">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<h3>Dettaglio Studente</h3>

				<div class="resume" id="resume">
					<div class="timeline">

						<div class="time-box">
							<div class="time-data">
								Nome
							</div>
							<div class="time-description">
								<strong><?php echo $details->Nome; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Cognome
							</div>
							<div class="time-description">
								<strong><?php echo $details->Cognome; ?></strong>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data di nascita
							</div>
							<div class="time-description">
								<strong><?php echo ($details->Data_n != '0000-00-00')? $details->Data_n : ""; ?></strong>
									
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Matricola
							</div>
							<div class="time-description">
								<strong><?php echo $details->Matricola; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Sesso
							</div>
							<div class="time-description">
								<strong><?php echo $details->Sesso; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Codice Fiscale
							</div>
							<div class="time-description">
								<strong><?php echo $details->CF; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Luogo di Nascita
							</div>
							<div class="time-description">
								<strong><?php echo $details->Luogo_n; ?> <?php echo ($details->Prov_n)? "(".$details->Prov_n.")" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Comune di residenza
							</div>
							<div class="time-description">
								<strong><?php echo $details->Luogo_r; ?> <?php echo ($details->Prov_r)? "(".$details->Prov_r.")" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Telefono
							</div>
							<div class="time-description">
								<strong><?php echo $details->Telefono; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Email
							</div>
							<div class="time-description">
								<strong><?php echo $details->e_mail; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Curriculum
							</div>
							<div class="time-description">
								<strong><?php echo $details->curriculum; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Titolo tesi
							</div>
							<div class="time-description">
								<strong><?php echo $details->Titolo_tesi; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Tipologia
							</div>
							<div class="time-description">
								<strong><?php echo $details->tipologia; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Relatore
							</div>
							<div class="time-description">
								<strong><?php echo $details->relatore; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Voto Laurea
							</div>
							<div class="time-description">
								<strong><?php echo $details->Voto_laurea; echo ($details->cum_laude == 'si')? " e lode" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data Laurea
							</div>
							<div class="time-description">
								<strong><?php echo $details->Data_Laurea; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Curriculum
							</div>
							<div class="time-description">
								<?php echo ($details->CV_download)? '<a href="'.$details->CV_download.'" class="view-more-student btn btn-warning">Scarica Curriculum</a>' : ''; ?>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Note
							</div>
							<div class="time-description">
								<strong><?php echo $details->Note; ?></strong>	
							</div>
						</div>


					</div>
				</div><br>

			<div class="text-center student-button">
				<a href="?controller=aziende&action=index" class="btn btn-warning">Torna Indietro</a>
			</div><br>

	</main>