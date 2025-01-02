<?php

/*
    Este script tem como intuito de verificar se o login ainda está ativo
    caso não esteja irá ser reencaminhado automaticamente para o login caso
    contrário irá para a dashboard desejada
*/
    session_start();

    if($_SESSION['Admin'] == null) {
        header('Location: http://localhost/JoelMalacas_FelipeBotelho/paginas/login.html');
    }
?>