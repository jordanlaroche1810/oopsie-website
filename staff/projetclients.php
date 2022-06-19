<?php
    session_start();
    include('include/header.php');
    include('../server/checkStaff.php');
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
                <button class="btn btn-dark"><a class="text-white" href="moncompte.php">Retour</a></button>
            </div>
            <div class="heading-text heading-section text-center">
                <h2>VOS CLIENTS</h2>
            </div>
            <div class="row">
                <div class="col-12">
            <table class="mt-5 mb-3 ">
                <thead>
                <!--Table Row 1-->
                <tr>
                    <th>Nom du clients</th>
                    <th>Téléphone</th>
                    <th>Mail</th>
                    <th>Date de dernière connexion</th>
                    <th>Nombre de projets</th>
                </tr>
                </thead>

                <tbody>
                
                <?php
                    $listUsers = $pdo->query("SELECT * FROM gd_users" );
                    while ($user = $listUsers->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <form class="table" action="projetliste.php" method="GET">
                                    <td>
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button style="all: unset; cursor: pointer;"> <?= $user['prenom'] ?> <?= $user['nom'] ?></button>
                                    </td>
                                </form>
                                <td><?= $user['tel'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td>
                                    <?php
                                        $dateProject = date_create($project['date_creation']);
						                $date_project = date_format($dateProject, 'd-m-Y');	
                                    ?>
                                    <?= $date_project ?>
                                </td>
                                <td>
                                    <?php
                                        $compteurProjects = $pdo->query("
                                        SELECT count(id) FROM gd_projects WHERE id_user ='".$user['id']."'"
                                        )->fetchColumn();

                                        if($compteurProjects > 1){
                                            ?>
                                                <?= $compteurProjects ?> projets réalisés
                                            <?php
                                        }else{
                                            ?>
                                                <?= $compteurProjects ?> projet réalisé
                                            <?php
                                        }
                                    ?>
                                </td>
                                
                                <form class="table" action="projetliste.php" method="GET">
                                    <td>
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button class="rounded-2 p-2">
                                            Accédez
                                        </button>
                                    </td>
                                </form>
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
                    $compteurProject = $pdo->query("
                    SELECT count(id) FROM gd_projects"
                    )->fetchColumn();
                ?>
                <?= $compteurProject ?> projets réalisés
            </button>
            </div>

           
        </div>
    </section>

<?php 
    include('include/footer.php')
?>

