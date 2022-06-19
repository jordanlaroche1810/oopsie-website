<?php
    session_start();
    ob_start();
    require_once "../include/db.php";
?>
<!-- Formulaire Inscription -->
<?php
    if(isset($_POST['create'])) {
        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password2']){
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $tel = htmlspecialchars($_POST['tel']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO gd_users (
                nom,
                prenom,
                email,
                tel,
                password
            )
            VALUES (
                ?,
		        ?,
		        ?,
		        ?,
                ?
            )";

            $insertUser = $pdo->prepare($sql)->execute([
                $nom,
                $prenom,
                $email,
                $tel,
                $password
            ]);

            $listUser = $pdo->query('SELECT * FROM gd_users WHERE email ="'.$_POST['email'].'" ');
            $user = $listUser->fetch(PDO::FETCH_ASSOC);

            if($listUser->rowCount() > 0){
                $_SESSION['id'] = $user['id'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['tel'] = $user['tel'];

                header('Location: ../index.php');
                ob_end_flush(); 
            }
        }
    }
?>

<!-- Formulaire Connexion -->
<?php
    if(isset($_POST['connexion'])) {

        $email = $_POST['email'];
	    $password = $_POST['password'];
        $last_visit = date("Y-m-d" ); 

        if(!empty($_POST['password']) && !empty($_POST['email'])){

            $listUser = $pdo->query('SELECT * FROM gd_users WHERE email ="'.$email.'" ');
            $user = $listUser->fetch(PDO::FETCH_ASSOC);
    
            if(!empty($user['email'])){
        
                $email = htmlspecialchars($_POST['email']);
                $id = $user['id'];
                $hash = $user['password'] ;
    
                if (password_verify($password , $hash)) {
            
                    $_SESSION['id'] = $id;
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['tel'] = $user['tel'];
                    $_SESSION['email'] = $email;

                    if($email == 'garden92000@gmail.com'){
                        $role = 'staff';
                    }else{
                        $role = 'customer';
                    }
            
                    // Create token header as a JSON string
                    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
                    $payload = json_encode(['user_id' => $id, 'email' => $email, 'role' => $role]);
                    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
                    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
                    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'yT6UT7s92qEf!', true);
                    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
                    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

                    $_SESSION['jwt'] = $jwt;
					$pdo->prepare("UPDATE gd_users SET jwt = :jwt, last_visit = :last_visit WHERE id = :id")->execute([
                        'jwt' => $jwt, 
                        'last_visit' => $last_visit, 
                        'id' => $id
                        ]);

                    $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
                    header('Location: ../index.php');
                    ob_end_flush();

                }else{
                    $_SESSION['flash']['error'] = 'Mot de passe invalide !';
                    header('Location: ../index.php');
                    ob_end_flush();
                }

            }else{
                $_SESSION['flash']['error'] = 'Mot de passe ou E-mail invalide !';
                header('Location: ../index.php');
                ob_end_flush();
            }
        }
    }
?> 

<!-- Formulaire Update Infos Compte -->
<?php
    if(isset($_POST['updateUser'])) {
            $id = $_POST['id'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];

            $pdo->prepare("UPDATE gd_users SET tel = :tel, email = :email WHERE id = :id")->execute(['tel' => $tel, 'email' => $email, 'id' => $id]);
            
            $_SESSION['flash']['success'] = 'Votre informations ont bien été modifiées';
            header('Location: ../moncompte.php');
            ob_end_flush();
        }
?> 

<!-- Formulaire Update mot de passe -->
<?php
    if(isset($_POST['updateMdp'])) {
        if(!isset($_POST['password']) or $_POST['password'] != $_POST['password2']){
            $_SESSION['flash']['error'] = 'Les 2 mots de passe ne sont pas identiques';
            header('Location: ../moncompte.php');
        }else{
            $id = $_POST['id'];
            
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $pdo->prepare("UPDATE gd_users SET password = '?' WHERE id = '?'")->execute([$password, $id]);
            
            $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
            header('Location: ../moncompte.php');
            ob_end_flush();
        }
    }
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
        header('Location: ../mesprojets.php');
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
                        $id_project = $_POST['id'];
                        move_uploaded_file($_FILES['audio']['tmp_name'], "../files/".$numero."".$extension."");
                        
                        $sql = "INSERT INTO gd_files (
                            id_user,
                            id_project,
                            nom,
                            nom_alt
                        )
                        VALUES (
                           ?,
                           ?,
                           ?,
                           ?
                        )";
                
                        $pdo->prepare($sql)->execute([
                            $id_user,
                            $id_project,
                            $numero.$extension,
                            $nom_alt
                        ]);			

                        $_SESSION['flash']['success'] = 'Vous avez ajouté un fichier';
                        header('Location: ../projet.php?id='.$id_project.'');
                        ob_end_flush();
                    }
                    else
                    {
                        $_SESSION['flash']['danger'] = 'La taille du fichier est trop volumineuse';
                        header('Location: ../mesprojets.php');
                        ob_end_flush();
                    }
                    
                }
                $_SESSION['flash']['danger'] = 'Une erreur est survenue lors de l\'envoi du fichier';
                header('Location: ../mesprojets.php');
                ob_end_flush();
            }
            $_SESSION['flash']['danger'] = 'Une erreur est survenue lors de l\'envoi du fichier';
            header('Location: ../mesprojets.php');
            ob_end_flush();
        }
        $_SESSION['flash']['danger'] = 'L\'extension du fichier n\'est pas authorisée';
        header('Location: ../mesprojets.php');
        ob_end_flush();
    }

?>

<!-- Formulaire de contact -->
<?php
    if(isset($_POST['contact'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $objet = "Demande contact page d'accueil";
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $date = date("Y-m-d" ); 

        $sql = "INSERT INTO gd_contact (
            nom,
            email,
            objet,
            date,
            commentaire
        )
        VALUES (
           ?,
           ?,
           ?,
           ?,
           ?
        )";

        $insertProject= $pdo->prepare($sql)->execute([
            $nom,
            $email,
            $objet,
            $date,
            $commentaire
        ]);

        $_SESSION['flash']['success'] = 'Votre demande a été transmise au Staff';
        header('Location: ../index.php');
        ob_end_flush();
    }
?> 

<!-- Formulaire contact page -->
<?php
    if(isset($_POST['contactPage'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $objet = htmlspecialchars($_POST['objet']);
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $date = date("Y-m-d" ); 

        $sql = "INSERT INTO gd_contact (
            nom,
            email,
            objet,
            date,
            commentaire
        )
        VALUES (
           ?,
           ?,
           ?,
           ?,
           ?
        )";

        $insertProject= $pdo->prepare($sql)->execute([
            $nom,
            $email,
            $objet,
            $date,
            $commentaire
        ]);

        $_SESSION['flash']['success'] = 'Votre demande a été transmise au Staff';
        header('Location: ../index.php');
        ob_end_flush();
    }
?> 

<!-- Formulaire Prise de résa -->
<?php
    if(isset($_POST['reservation'])) {
        $id_user = $_POST['id_user'];
        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $prestation = htmlspecialchars($_POST['prestation']);
        $date = $_POST['date'];
        $heure_debut = htmlspecialchars($_POST['heure_debut']);
        $duree = $_POST['duree'];

        $sql = "INSERT INTO gd_reservation (
            id_user,
            nom,
            email,
            tel,
            prestation,
            date,
            heure_debut,
            duree
        )
        VALUES (
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?,
           ?
        )";

        $insertProject= $pdo->prepare($sql)->execute([
            $id_user,
            $nom,
            $email,
            $tel,
            $prestation,
            $date,
            $heure_debut,
            $duree
        ]);

        $_SESSION['flash']['success'] = 'Votre demande a été transmise au Staff';
        header('Location: ../index.php');
        ob_end_flush();
    }
?> 