<?php

    //Ligar base de dados
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'felixbus';
    
    $conn = mysqli_connect($server, $user, $pass, $database) or die("Erro ao ligar a base de dados");

    try {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $passe = hash('sha256', $_POST['passe']); // com encriptação SHA-256
        $nif = $_POST['nif'];
        $telemovel = $_POST['telemovel'];

        // Verifica se o usuário já existe
        $verifica = "SELECT * FROM cliente WHERE email = '$email' AND NIF = '$nif'";
        $resultVerifica = mysqli_query($conn, $verifica);

        if (mysqli_num_rows($resultVerifica) == 0) {
            // Insere na tabela cliente
            $sql = "INSERT INTO cliente (nome, password, email, NIF, telemovel, estado, status) 
                    VALUES ('$nome', '$passe', '$email', '$nif', '$telemovel', 'PENDENTE', 'OFFLINE')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Obtém o ID inserido
                $id = mysqli_insert_id($conn);

                // Insere na tabela carteira
                $sqlCarteira = "INSERT INTO carteira (id, NIF, saldo) VALUES ($id, '$nif', 0.0)";
                $resultCarteira = mysqli_query($conn, $sqlCarteira);

                if ($resultCarteira) {
                    print '<script>alert("Utilizador criado com sucesso!!!")</script>';
                    print '<script>window.location.href = "http://localhost/JoelMalacas_FelipeBotelho/paginas/login.html"</script>';
                } else {
                    print '<script>alert("Erro ao criar a carteira do utilizador!");window.location.href="http://localhost/JoelMalacas_FelipeBotelho/paginas/signup.html"</script>';
                }
            } else {
                print '<script>alert("Erro ao criar o utilizador!");window.location.href="http://localhost/JoelMalacas_FelipeBotelho/paginas/signup.html"</script>';
            }
        } else {
            print '<script>alert("Já existe um utilizador com este email!");window.location.href="http://localhost/JoelMalacas_FelipeBotelho/paginas/signup.html"</script>';
        }
    } catch (Exception $e) {
        echo 'Erro: ',  $e->getMessage(), "\n";
    }

    mysqli_close($conn);
?>
