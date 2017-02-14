<!-- Corpo centrale del sito -->
	<main id="areastudenti">

		<div class="logged-menu">
			<div class="container">
				<div class=" float-right">
					<i class="fa fa-graduation-cap" aria-hidden="true"></i> <a href="?controller=studenti&action=index"><strong><?php echo $students->Nome; ?> <?php echo $students->Cognome; ?></strong></a> | <a href="?controller=studenti&action=logout">Logout</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="container">

			<h3>Area Studenti</h3>
			<p class="lead">Lorem Ipsum Dolor Sit amet.</p>

				<div class="resume" id="resume">
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
								<strong><?php echo ($students->Data_n != '0000-00-00')? $students->Data_n : ""; ?></strong>
									
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
								<strong><?php echo $students->CF; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Luogo di Nascita
							</div>
							<div class="time-description">
								<strong><?php echo $students->Luogo_n; ?> <?php echo ($students->Prov_n)? "(".$students->Prov_n.")" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Comune di residenza
							</div>
							<div class="time-description">
								<strong><?php echo $students->Luogo_r; ?> <?php echo ($students->Prov_r)? "(".$students->Prov_r.")" : ""; ?></strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Telefono
							</div>
							<div class="time-description">
								<strong><?php echo $students->Telefono; ?></strong>	
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
								<?php echo ($students->CV_download)? '<a href="'.$students->CV_download.'" class="view-more-student btn btn-warning">Scarica Curriculum</a>' : ''; ?>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Note
							</div>
							<div class="time-description">
								<strong><?php echo $students->Note; ?></strong>	
							</div>
						</div>


					</div>
				</div><br>

			<div class="text-center student-button">
				<a href="?controller=studenti&action=impostazioni" class="btn btn-warning">Modifica Dati</a>
				<button type="button" class="btn btn-warning" id="openInviaCurriculum">Invia Curriculum</button>
				<?php echo ($students->Tesi_download)? '<a href="'.$students->Tesi_download.'" class="btn btn-warning">Scarica Tesi</a>' : ''; ?>
				
			</div><br>



			<div class="modal fade" id="inviaCurriculum">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Carica il tuo Curriculum</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					  <input type="file" id="file">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-warning">Carica</button>
			      </div>
			    </div>
			  </div>
			</div>

	</main>