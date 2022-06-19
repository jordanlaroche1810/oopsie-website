<?php
    session_start();
    ob_start();
    require_once "../include/db.php";
?>
<!-- Formulaire Ajout de projet -->
<?php
    if(isset($_POST['createProject'])) {
        $id_user = $_POST['id_user'];
        $nom = htmlspecialchars($_POST['nom']);
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $date = date("Y-m-d" ); 

        $sql = "INSERT INTO gd_projects (
            id_user,
            nom,
            date_creation,
            commentaire
        )
        VALUES (
           ?,
           ?,
           ?,
           ?
        )";

        $insertProject= $pdo->prepare($sql)->execute([
            $id_user,
            $nom,
            $date,
            $commentaire
        ]);

        $_SESSION['flash']['success'] = 'Vous avez ajouté un projet';
        header('Location: ../projetliste.php?id='.$id_user.'');
        ob_end_flush();
    }
?> 

<!-- Upload fichier -->
<?php

    if(isset($_POST['ajoutFichier'])) {

        $nom_alt = $_FILES['audio']['name'];

        $extensions = array('.mp3', '.MP3', '.wav', '.WAV', '.pdf', '.PDF');
        $extension = strrchr($_FILES['audio']['name'], '.');
        
        if(!in_array($extension, $extensions)) {

            header('Location: mesprojets.php');
            ob_end_flush();
        
        }else{
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                if (isset($_FILES['audio']) AND $_FILES['audio']['error'] == 0)
                {
                    if ($_FILES['fichier']['size'] <= 300000000){
                        $numero = $_POST['numero'];
                        $id_user = $_POST['id_user'];
                        $id_staff = $_POST['id_staff'];
                        $id_project = $_POST['id'];
                        move_uploaded_file($_FILES['audio']['tmp_name'], "../../files/".$numero."".$extension."");
                        
                        $sql = "INSERT INTO gd_files (
                            id_user,
                            id_staff,
                            id_project,
                            nom,
                            nom_alt
                        )
                        VALUES (
                           ?,
                           ?,
                           ?,
                           ?,
                           ?
                        )";
                
                        $pdo->prepare($sql)->execute([
                            $id_user,
                            $id_staff,
                            $id_project,
                            $numero.$extension,
                            $nom_alt
                        ]);			

                        $_SESSION['flash']['success'] = 'Vous avez ajouté un fichier';
                        header('Location: ../projets.php?id='.$id_project.'');
                        ob_end_flush();
                    }
                    else
                    {
                        $_SESSION['flash']['success'] = 'Une erreur est survenue lors de l\'envoi du fichier';
                        header('Location: ../mesprojets.php');
                        ob_end_flush();
                    }
                }
            }
        }
    }

?>

<!-- Delete projet -->
<?php
    if(isset($_POST['deleteProject'])) {
        $id = $_POST['id'];
        $id_user = $_POST['id_user'];

        $listFiles = $pdo->query("SELECT * FROM gd_files WHERE id_project = '".$id."' " );
        $files= $listFiles->fetch(PDO::FETCH_ASSOC);

        $filename = $files['nom'];
        unlink('../../files/"'.$filename.'"');

        

        $sql = "DELETE FROM gd_projects WHERE id=?";
        $pdo->prepare($sql)->execute([$id]);

        $sql2 = "DELETE FROM gd_files WHERE id_project=?";
        $pdo->prepare($sql2)->execute([$id]);

        $_SESSION['flash']['success'] = 'Projet supprimé';
        header('Location: ../projetliste.php?id='.$id_user.'');
        ob_end_flush();
    }
?> 

<!-- Update Résa -->
<?php
    if(isset($_POST['updateResa'])) {
        $id = $_POST['id_resa'];
        $statut = $_POST['statut'];

        $pdo->prepare("UPDATE gd_reservation SET statut = :statut WHERE id = :id")->execute(['statut' => $statut, 'id' => $id]);

        $_SESSION['flash']['success'] = 'Statut changé';
        header('Location: ../resaclient.php');
        ob_end_flush();
    }
?> 