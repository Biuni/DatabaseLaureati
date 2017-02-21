	<!-- Corpo centrale del sito -->
	<main id="loginaziende">

		<div class="container">

			<h3 class="log-aziende">Area Riservata</h3>
			<p class="lead">Area ad uso esclusivo del personale.</p>

			<h4 class="form-title">
				<i class="fa fa-lock" aria-hidden="true"></i>
			</h4>

			<form method="post" action="" id="form-log-aziende">

			<div class="alert alert-danger <?php echo $hide; ?>" role="alert">
			  <strong>Login non riuscito!</strong><br>Username o password non corretti.
			</div>

				<div class="form-group input-user_aziende">
				<i class="fa fa-user-o"></i>
					<input type="text" class="form-control form-control-danger" id="user_aziende" name="username" placeholder="Username">
				</div>
				<div class="form-group input-pwd_aziende">
				<i class="fa fa-lock"></i>
					<input type="password" class="form-control form-control-danger" id="pwd_aziende" name="password" placeholder="Password">
				</div>

				<div class="form-group button-log">
					<button type="submit" class="btn btn-warning btn-block">Login</button>
				</div>

			</form><br>

		</div>

	</main>