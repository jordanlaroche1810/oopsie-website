<?php
    session_start();
    include('include/header.php');
    include('php/checkUser.php');
?>
    <section>
        <div class="container">
            <div class="mt-3 text-start mb-5">
                <button class="btn btn-dark"><a class="text-white" href="javascript:history.go(-1)">Retour</a></button>
            </div>
            <form class="mt-5 mb-3" action="server/functions.php" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du nouveau projet de votre client</label>
                    <input type="text" class="form-control" name="nom" id="nom" >
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" name="commentaire"  id="commentaire"></textarea>
                </div>
                <input type="hidden" name="id_user" value="<?= $_GET['id']?>">
                <button type="submit" name="createProject" value="1" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </section>


<?php 
    include('include/footer.php')
?>