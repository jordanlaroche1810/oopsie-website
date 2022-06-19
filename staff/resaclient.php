<?php
    session_start();
    include('include/header.php');
    include('server/checkStaff.php');
?>

<style>
table {  
    width: 100%;
    height: 100%;
    text-align: center;
    
}

th, tfoot td {
    color: white;
    background-color: #57233A;
    border: solid black;

}

th {
    font-family: 'Poppins', sans-serif; 
    background-color: #57233A;
    padding: 10px;
}

.thAjout {
    font-family: 'Poppins', sans-serif; 
    background-color: #A18F97;
    padding: 10px;
}

td {
    font-family: 'Poppins', sans-serif;
    padding: 20px;
    border-radius: 25px;
    border: solid black;
}
</style>

    <section>
        <div class="container">
            <div class="mt-3 text-start">
                <button class="btn btn-dark"><a class="text-white" href="moncompte">Retour</a></button>
            </div>
            <div class="heading-text heading-section text-center">
                <h2>RÉSERVATIONS CLIENTS</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="mt-5 mb-3">
                        <thead>
                        <!--Table Row 1-->
                        <tr>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Date</th>
                            <th>Heure Début</th>
                            <th>Durée</th>
                            <th>Prestation</th>
                            <th>Statut</th>
                        </tr>
                        </thead>

                        <tbody>
                            <?php
                                $listResa = $pdo->query("SELECT * FROM gd_reservation" );
                                while ($resa = $listResa->fetch(PDO::FETCH_ASSOC)) {

                                    $requser = $pdo->query("SELECT * FROM gd_users WHERE id ='".$resa['id_user']."'" );
                                    $user = $requser->fetch(PDO::FETCH_ASSOC)

                                    ?>
                                        <tr>
                                            <!--Table Row 2-->
                                            <td>
                                                <?= $user['prenom'] ?> <?= $user['nom'] ?>
                                            </td>
                                            <td>
                                                <?= $resa['tel'] ?>
                                            </td>
                                            <td> 
                                                <?php
                                                    $dateProject = date_create($resa['date_creation']);
                                                    $date_resa = date_format($dateProject, 'd-m-Y');	
                                                ?>
                                                <?= $date_resa ?>
                                            </td>
                                            <td><?= $resa['heure_debut'] ?></td>
                                            <td><?= $resa['duree'] ?>h</td>
                                            <td><?= $resa['prestation'] ?></td>
                                            <td>
                                                <?php
                                                    if($resa['statut'] == "En attente"){
                                                        ?>
                                                            <span class="text-warning"><?= $resa['statut'] ?></span>
                                                        <?php
                                                    } else if($resa['statut'] == "Validé"){
                                                        ?>
                                                            <span class="text-success"><?= $resa['statut'] ?></span>
                                                        <?php
                                                    } else if($resa['statut'] == "Annulé"){
                                                        ?>
                                                            <span class="text-danger"><?= $resa['statut'] ?></span>
                                                        <?php
                                                    } else if($resa['statut'] == "Archivé"){
                                                        ?>
                                                            <span class="text-muted"><?= $resa['statut'] ?></span>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <form action="server/functions.php" method="POST">
                                                    <div class="form-group">
                                                        <span class="form-label">Changer le statut</span>
                                                        <select name="statut" class="form-control" onchange="if(this.value != 0) { this.form.submit(); }">
                                                            <option selected disabled><?= $resa['statut'] ?></option>
                                                            <option>En attente</option>
                                                            <option>Validé</option>
                                                            <option>Annulé</option>
                                                            <option>Archivé</option>
                                                        </select>
                                                        <input type="hidden" name="id_resa" value="<?= $resa['id']?>">
                                                        <input type="hidden" name="updateResa" value="1">
                                                        <span class="select-arrow"></span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 mt-6">
            <button class="btn btn-roundeded btn-dark">
                <?php
                    $compteurrESA = $pdo->query("
                    SELECT count(id) FROM gd_reservation"
                    )->fetchColumn();
                ?>
                <?= $compteurrESA ?> Réservations réalisées
            </button>
            </div>

           
        </div>
    </section>

<?php 
    include('include/footer.php')
?>

