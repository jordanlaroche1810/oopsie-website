<?php 
	session_start();  
	ob_start();
    include('include/header.php');

	if(!isset($_SESSION['id'])){
		$_SESSION['flash']['danger'] = 'Vous devez d\'abord vous connecter';
		header('Location: /connexion.php');
		ob_end_flush();
	}

	$requser = $pdo->query("SELECT * FROM gd_users WHERE id ='".$_SESSION['id']."'" );
    $user = $requser->fetch(PDO::FETCH_ASSOC)
?>

<div id="booking" class="back-circ3">
	<div class="section-center">
		<div class="container">
			<div class="row">
				<div class="booking-form">
					<div class="form-header">
						<div class="heading-text heading-section">
							<h1>RÉSERVEZ VOTRE SESSION</h1>
						</div>
						<img class="souli3" src="./img/souli.png" alt="">
					</div>
					<form action="server/functions.php" method="POST">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<span class="form-label">Nom</span>
									<input class="form-control" name="nom" type="text"
										value="<?= $user['prenom']?> <?= $user['nom']?>">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<span class="form-label">Téléphone</span>
									<input class="form-control" name="tel" type="tel" value="<?= $user['tel']?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<span class="form-label">Email</span>
							<input class="form-control" name="email" type="email" value="<?= $user['email']?>">
						</div>
						<div class="col-sm-5">
							<div class="form-group">
								<span class="form-label">Prestation</span>
								<select name="prestation" class="form-control">
									<option>Enregistrement / Premixage</option>
									<option>Mixage</option>
									<option>Instrumental</option>
								</select>
								<span class="select-arrow"></span>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<span class="form-label">Date</span>
									<input class="form-control" name="date" type="date" required>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<span class="form-label">Heure</span>
											<select name="heure_debut" class="form-control">
												<option>12h</option>
												<option>13h</option>
												<option>14h</option>
												<option>15h</option>
												<option>16h</option>
												<option>17h</option>
												<option>18h</option>
												<option>19h</option>
												<option>20h</option>
												<option>21h</option>
												<option>22h</option>
												<option>23h</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Durée de la session</span>
											<select name="duree" class="form-control">
												<option>1h</option>
												<option>2h</option>
												<option>3h</option>
												<option>4h</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-btn">
							<input type="hidden" name="id_user" value="<?= $_SESSION['id']?>">
							<button name="reservation" value="1" class="btn btn-primary">Réserver</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php   
    include('include/footer.php');
?>