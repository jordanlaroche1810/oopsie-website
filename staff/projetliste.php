<?php
    session_start();
    include('include/header.php');
    include('server/checkStaff.php');

    $listClients = $pdo->query("SELECT * FROM gd_users WHERE id = '".$_GET['id']."'" );
    $client = $listClients->fetch(PDO::FETCH_ASSOC);

    $listProject = $pdo->query("SELECT * FROM gd_projects WHERE id ='".$project['id_user']."' " );
    $project = $listProject->fetch(PDO::FETCH_ASSOC);

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
                <button class="btn btn-dark"><a class="text-white" href="projetclients.php">Retour</a></button>
            </div>
            <div class="heading-text heading-section text-center">
                <h2>PROJETS : <?= $client['prenom'] ?> <?= $client['nom'] ?></h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="mt-5 mb-3">
                        <thead>
                        <!--Table Row 1-->
                        <tr>
                            <th>Nom du projet</th>
                            <th>Date de création</th>
                            <th>Nombre de fichiers joints</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                            $listProject = $pdo->query("SELECT * FROM gd_projects WHERE id_user ='".$_GET['id']."' " );
                            while ($project = $listProject->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <form class="table" action="projet.php" method="GET">
                                            <td>
                                                <input type="hidden" name="id" value="<?= $project['id'] ?>">
                                                <button style="all: unset; cursor: pointer;"> <?= $project['nom'] ?> </button>
                                            </td>
                                        </form>
                                        <td>
                                            <?php
                                                $dateProject = date_create($project['date_creation']);
                                                $date_project = date_format($dateProject, 'd-m-Y');	
                                            ?>
                                            <?= $date_project ?>
                                        </td>
                                        <td>
                                            <?php
                                                $compteurFiles = $pdo->query("
                                                SELECT count(id) FROM gd_files WHERE id_project ='".$project['id']."'"
                                                )->fetchColumn();

                                                if($compteurFiles > 1){
                                                    ?>
                                                        <?= $compteurFiles ?> fichiers rattachés
                                                    <?php
                                                }else{
                                                    ?>
                                                        <?= $compteurFiles ?> fichier rattaché
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        
                                        <form class="table" action="projet.php" method="GET">
                                            <td>
                                                <input type="hidden" name="id" value="<?= $project['id'] ?>">
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
                    SELECT count(id) FROM gd_projects WHERE id_user ='".$_GET['id']."'"
                    )->fetchColumn();
                ?>
                <?= $compteurProject ?> projets réalisés
            </button>
            <form class="table" action="ajoutprojet.php" method="GET">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <button class="btn btn-roundeded btn-dark" >Ajouter un projet au client</button>
            </form>
            </div>

           
        </div>
    </section>

<?php 
    include('include/footer.php')
?>

