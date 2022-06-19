<?php   
    include('include/header.php');
?>

<!-- Section -->
<section class="back-circ">
    <section class="pt-5 pb-5">
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">

                    <div class="heading-text heading-section">
                        <h2>Créer un compte</h2>
                    </div>
                    <p>Renseignez le formulaire d'inscription, cliquez sur "Envoyer" puis connectez-vous pour accéder à
                        votre espace en ligne.</p>
                    <form action="server/functions.php" id="form1" method="POST" class="form-validate mt-5">
                        <div class="h5 mb-4">Détails du compte</div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" name="nom" placeholder="Entrer votre nom"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" name="prenom" placeholder="Entrer votre prénom"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tel">Téléphone</label>
                                <input type="text" class="form-control" name="tel" placeholder="Entrez votre téléphone"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Entrez votre email"
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Mot de passe</label>
                                <div class="input-group show-hide-password">
                                    <input class="form-control" name="password" placeholder="Entrer votre mot de passe"
                                        type="text" required>
                                    <span class="input-group-text"><i class="icon-eye" aria-hidden="true"
                                            style="cursor: pointer;"></i></span>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password2">Confirmez le mot de passe</label>
                                <div class="input-group show-hide-password">
                                    <input class="form-control" name="password2"
                                        placeholder="Entrer de nouveau le mot de passe" type="password" required>
                                    <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true"
                                            style="cursor: pointer;"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="terms_conditions" id="terms_conditions"
                                class="form-check-input" value="1" required="">
                            <label class="custom-control-label" for="terms_conditions">En cochant cette case, vous
                                certifiez avoir lu la <a href="#">politique de confidentialité</a>.</label>
                        </div>
                        <button type="submit" name="create" value="1" class="btn m-t-30 mt-3">Envoyer</button>
                    </form>
                    <div class="mt-4"><small>Vous avez déjà un compte ?</small> <a href="connexion"
                            class="small fw-bold">Connectez-vous</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- end: Section -->




<?php   
    include('include/footer.php');
?>