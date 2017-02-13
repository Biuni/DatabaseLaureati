<!-- Corpo centrale del sito -->
	<main id="areastudenti">

		<div class="logged-menu">
			<div class="container">
				<div class=" float-right">
					<i class="fa fa-graduation-cap" aria-hidden="true"></i> <a href="?controller=studenti&action=index"><strong><?php echo $username; ?></strong></a> | <a href="?controller=studenti&action=logout">Logout</a>
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
								<strong>Gianluca</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Cognome
							</div>
							<div class="time-description">
								<strong>Bonifazi</strong>
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data di nascita
							</div>
							<div class="time-description">
								<strong>1994-12-29</strong>
									
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Matricola
							</div>
							<div class="time-description">
								<strong>261989</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Sesso
							</div>
							<div class="time-description">
								<strong>M</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Codice Fiscale
							</div>
							<div class="time-description">
								<strong>BNFGLCT29H211J</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Luogo di Nascita
							</div>
							<div class="time-description">
								<strong>Recanati (MC)</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Comune di residenza
							</div>
							<div class="time-description">
								<strong>Castelfidardo (AN)</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Telefono
							</div>
							<div class="time-description">
								<strong>3376545321</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Email
							</div>
							<div class="time-description">
								<strong>info@biuni.it</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Curriculum
							</div>
							<div class="time-description">
								<strong>indefinito</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Titolo tesi
							</div>
							<div class="time-description">
								<strong>Progettazzione e realizzazzione di una web app per la gestione del database dei laureati del corso di laurea.</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Tipologia
							</div>
							<div class="time-description">
								<strong>Sperimentale</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Relatore
							</div>
							<div class="time-description">
								<strong>Aldini Alessandro</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Voto Laurea
							</div>
							<div class="time-description">
								<strong>NaN</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Data Laurea
							</div>
							<div class="time-description">
								<strong>2017-06-20</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Visibilità
							</div>
							<div class="time-description">
								<strong>
								<i class="fa fa-check" aria-hidden="true"></i> (visibile) |
								<i class="fa fa-times" aria-hidden="true"></i> (nascosto)
								</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Curriculum
							</div>
							<div class="time-description">
								<strong>Non presente</strong>	
							</div>
						</div>

						<div class="time-box">
							<div class="time-data">
								Note
							</div>
							<div class="time-description">
								<strong>Lorem Ipsum Dolor Sit Amet</strong>	
							</div>
						</div>


					</div>
				</div><br>

			<div class="text-center student-button">
				<a href="?controller=studenti&action=impostazioni" class="btn btn-warning">Modifica Dati</a>
				<button type="button" class="btn btn-warning" id="openInviaCurriculum">Invia Curriculum</button>
				<a href="#" class="btn btn-warning">Scarica Tesi</a>
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