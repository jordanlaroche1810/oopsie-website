<?php   
    session_start();
    include('include/header.php');

    $listUser = $pdo->query("SELECT * FROM gd_users WHERE email ='".$_SESSION['email']."' ");
    $user = $listUser->fetch(PDO::FETCH_ASSOC);
?>

<section>
    <div class="container">
        <div class="mt-3 text-start">
            <button class="btn btn-dark"><a class="text-white" href="../">Retour</a></button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="heading-text heading-section mt-5">
                    <h2>Bienvenue sur votre espace <span class="text-danger">staff</span> <span style="color: #57233A"><?= $user['prenom'] ?> <?= $user['nom'] ?></span></h2>
                </div>
                <p>C'est ici que vous pourrez piloter les projets musicaux de vos clients, gérer votre compte, vos réservations, ...
                </p>
                <a href="../mesprojets.php" class="btn btn-dark">Mes projets</a>
                <a href="resaclient.php" class="btn btn-dark">Mes réservations</a>
                <a href="projetclients.php" class="btn btn-dark">Projets clients</a>
            </div>
            <div class="col-lg-6 m-t-50">
                <div class="heading-text heading-section mt-5">
                    <h2>Vos informations</h2>
                </div>
                    <form action="server/functions.php" id="form1" method="POST" class="form-validate mt-5">
                        <div class="h5 mb-4">Détails du compte</div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nom">Nom</label>
                                <input disabled type="text" class="form-control" name="nom" value="<?= $user['nom'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prenom">Prénom</label>
                                <input disabled type="text" class="form-control" name="prenom" value="<?= $user['prenom'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tel">Téléphone</label>
                                <input type="text" class="form-control" name="tel" value="<?= $user['tel'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit" name="updateUser" value="1" class="btn mt-1">Modifier</button>
                    </form>
                    <form action="server/functions.php" id="form1" method="POST" class="form-validate mt-5">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Changer de mot de passe</label>
                                <div class="input-group show-hide-password">
                                    <input class="form-control" name="password" placeholder="Entrer votre mot de passe" type="password" autocomplete="off">
                                    <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password2">Confirmez le mot de passe</label>
                                <div class="input-group show-hide-password">
                                    <input class="form-control" name="password2" placeholder="Entrer de nouveau le mot de passe" type="password" autocomplete="off">
                                    <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        <button type="submit" name="updateMdp" value="1" class="btn mt-1">Modifier</button>
                    </form>
            </div>
        </div>

    </div>

</section>

<?php   
    include('include/footer.php');
?>