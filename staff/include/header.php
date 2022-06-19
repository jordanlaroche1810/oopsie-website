<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Garden Team" />
    <meta name="description" content="Studio d'enregistrement situé à Nanterre">
    <link rel="icon" type="image/png" href="../../images/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Garden Studio - Votre studio d'enregistrement à Nanterre</title>
    <!-- Stylesheets & Fonts -->
    <link href="../css/plugins.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>


<?php
    session_start();
    require_once('db.php');
?>

<body>

    <!-- Body Inner -->
    <div class="body-inner">

        <!-- Header -->
        <header id="header" class="light submenu-light">
            <div class="header-inner">
                <div class="container">
                    <!--Logo-->
                    <div id="logo">
                        <a href="/">
                            <img class="logo-default" src="../images/Logonav.svg" alt="Logo Garden Studio">
                        </a>
                    </div>
                    <!--End: Logo-->
                    <!--Header Extras-->
                   
                    <!--end: Header Extras-->
                    <!--Navigation Resposnive Trigger-->
                    <div id="mainMenu-trigger"> <a class="lines-button x"><span class="lines"></span></a> </div>
                    <!--end: Navigation Resposnive Trigger-->
                    <!--Navigation-->
                    <div id="mainMenu">
                        <div class="container">
                            <nav>
                                <ul>
                                    <li><a href="../studio.php">Studio</a></li>
                                    <li><a href="../tarifs.php">Tarifs</a></li>
                                    <li><a href="../actualites.php">Actualités</a></li>
                                    <li><a href="../contact.php">Contact</a></li>
                                    <li><a href="../reservation.php"><button type="button" class="btn btn-roundeded btn-dark">Réserver</button></li></a>
                                    <li>
                                        <div class="dropdown">
                                            <button style="background-color: transparent; border: none;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                                <img class="menu-user" src="../images/user.png" alt="">
                                            </button>
                                            <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" style="text-decoration: none;" href="moncompte.php">Mon compte Staff</a></li>     
                                                <li><a class="dropdown-item" style="text-decoration: none;" href="../server/deconnexion.php"><span class="text-danger">Déconnexion</span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!--end: Navigation-->
                </div>
            </div>
        </header>
        <?php if (!empty($_SESSION['flash']['success'])){
            ?>
                <script>
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 6000);
                </script>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flash']['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            unset($_SESSION['flash']['success']); 	
        }
        ?>
        <?php if (!empty($_SESSION['flash']['error'])){
            ?>
                <script>
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 6000);
                </script>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flash']['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            unset($_SESSION['flash']['error']); 	
        }
        ?>
        <!-- end: Header -->