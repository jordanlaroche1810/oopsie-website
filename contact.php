<?php   
    session_start();
    include('include/header.php');
?>

<!-- CONTENT -->
<section class="back-circ">
    <section class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="text-uppercase">Contactez-nous</h3>
                    <p>Nous sommes là pour répondre à vos questions et vous donner une réponse le plus rapidement
                        possible. La réservation est accessible depuis notre site internet en cliquant sur le bouton
                        réserver.</p>
                    <div class="m-t-30">
                        <form action="../server/functions.php" method="POST">
                            <fieldset class="form-group">
                                <input type="text" name="nom" class="form-control" id="exampleInputname1"
                                    placeholder="Entrez votre nom">
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Entrez votre email">
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="text" name="objet" class="form-control" id="exampleInputname1"
                                    placeholder="Entrez un objet">
                            </fieldset>
                            <fieldset class="form-group">
                                <textarea name="commentaire" class="form-control" id="exampleMessage"
                                    placeholder="Message"></textarea>
                            </fieldset>
                            <fieldset class="form-group text-xs-right">
                                <button type="submit" name="contactPage" value="1" class="btn btn-dark">Envoyer</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 offset-1">
                    <h3 class="text-uppercase">Adresse</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <address>
                                <strong>Garden Studio</strong><br>
                                Place de la boulle<br>
                                92000, Nanterre<br>
                                <abbr title="Phone">Téléphone :</h4> <a href="tel:0756953457"> 07 56 95 34 57</a></p>
                                    </li>
                            </address>
                        </div>

                    </div>
                </div>
            </div>
    </section>
</section>
<!-- end: Content -->

<?php   
    include('include/footer.php');
?>