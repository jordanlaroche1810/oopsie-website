<?php
    session_start();
    include('include/header.php');
    require_once('../server/checkStaff.php');

    $listProject = $pdo->query("SELECT * FROM gd_projects WHERE id ='".$_GET['id']."' " );
    $project = $listProject->fetch(PDO::FETCH_ASSOC);

    $listClients = $pdo->query("SELECT * FROM gd_users WHERE id = '".$project['id_user']."'" );
    $client = $listClients->fetch(PDO::FETCH_ASSOC);
?>

<style>
    table {  
        width: 100%;
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
            <div class="mt-3 text-start mb-5">
                <button class="btn btn-dark"><a class="text-white" href="projetliste.php?id=<?= $project['id_user'] ?>">Retour</a></button>
                <form action="server/functions.php" method="POST">
                    <input type="hidden" name="id_user" value="<?= $project['id_user'] ?>" /> 
                    <input type="hidden" name="id" value="<?= $project['id'] ?>" />  
                    <button type="submit" name="deleteProject" value="1" class="btn btn-danger"><a class="text-white">Supprimer le projet</a></button>
                </form>
            </div>
            <div class="row">
                <div class="col-6">
                    <div>
                        <h2 style="line-height: 1.1em"><span style="color: #57233A"><?= $project['nom'] ?></span></h2>
                        <img class="souli" src="./img/souli.png" alt="">

                        <h3>Commentaire associé au projet :</h3>
                        <p> <?= $project['commentaire'] ?> </p>


                        <br/>
                        <label>Ajoutez un fichier au projet :</label>
                        <div>
                            <form action="server/functions.php" method="POST" enctype="multipart/form-data">
                                <div>
                                    <input type="file" name="audio">
                                    <input type="hidden" name="numero" value="<?php echo uniqid(); ?>" /> 
                                    <input type="hidden" name="id_staff" value="<?= $_SESSION['id'] ?>" /> 
                                    <input type="hidden" name="id_user" value="<?= $project['id'] ?>" /> 
                                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>" />  
                                </div>
                                <div>
                                    <button class="btn btn-dark" type="submit" name="ajoutFichier">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom des fichiers associés</th>
                                <!-- <th>Date d'import</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $listFiles = $pdo->query("SELECT * FROM gd_files WHERE id_project ='".$project['id']."' " );
                                while ($file = $listFiles->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr style="max-height: 100px">
                                            <td>
                                                <a href="files/<?= $file['nom']?>" download="<?= $file['nom_alt'] ?>"><?= $file['nom_alt'] ?></a>
                                                <div>Ajouté par : 
                                                    <?php 
                                                        if($file['id_staff'] == NULL){
                                                            ?>
                                                                <?= $client['prenom'] ?> <?= $client['nom'] ?>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                SALAKID
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


<?php 
    include('include/footer.php')
?>