<?php
    ob_start();

    $payload = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $_SESSION['jwt'])[1])))); 

    if($project['id_user'] == $payload->user_id) {
        $success = "Success";
    }else{
        print("<script language=\"javascript\" type=\"text/javascript\">window.location.replace(\"/\");</script>");
        $_SESSION['flash']['error'] = 'Ce projet ne vous appartient pas !';
        header('Location: /');
        ob_end_flush();
    }
?>