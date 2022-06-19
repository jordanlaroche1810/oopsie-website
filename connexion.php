<?php   
    include('include/header.php');
?>

    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Section -->
        <section class="back-circ">
            <div class="container-fluid d-flex flex-column">
                <div class="row align-items-center min-vh-100">
                    <div class="col-md-6 col-lg-4 col-xl-3 mx-auto">
                          <div class="card">
                            <div class="card-body py-5 px-sm-5">
                                <div class="mb-5 text-center">
                                    <h3 class="h3 mb-1">Connexion</h3>
                                    <p class="text-muted mb-0">Connectez-vous pour suivre l'avancée de votre projet et téléchager vos pistes.</p>
                                </div><span class="clearfix"></span>
                                <form action="server/functions.php" method="POST" class="form-validate">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email" placeholder="Entrez votre email" required>
                                            <span class="input-group-text"><i class="icon-user"></i></span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password">Mot de passe</label>
                                        <div class="input-group show-hide-password">
                                            <input class="form-control" name="password" placeholder="Entrez votre mot de passe" type="password" required="">
                                            <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                        </div>
                                    </div>
                                    <div class="mt-4"><button type="submit" name="connexion" value="1" class="btn btn-primary btn-block btn-primary">Se connecter</button></div>
                                </form>
                                <div class="mt-4 text-center"><small>Pas encore de compte ?</small> <a href="inscription" class="small fw-bold">Créer un compte</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Section -->
    </div>
    
                    
    <?php   
    include('include/footer.php');
?>