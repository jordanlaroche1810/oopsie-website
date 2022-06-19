<?php
    ob_start();
    $payload = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $_SESSION['jwt'])[1])))); 

    if($_SESSION['id'] == $payload->user_id) {
        $success = "Success";
    }else{
        header('Location: /');
        ob_end_flush();
    }
?>