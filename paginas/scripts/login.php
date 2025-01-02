<?php
    session_start();

    //Ligar base de dados
    $server = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'felixbus';

    $conn = mysqli_connect($server, $user, $pass, $database) or die("Erro ao ligar a base de dados");

    $User = $_POST['Email'];
    $Pass = $_POST['Password'];

    // Consulta para verificar se é administrador
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM admin_func WHERE email = ? AND password = SHA2(?, 256)");
    $stmt->bind_param("ss", $User, $Pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) == 1) {
        $Cargo_Verify = "SELECT cargo FROM admin_func WHERE email = ?";
        $stmt = mysqli_prepare($GLOBALS['conn'], $Cargo_Verify);
        mysqli_stmt_bind_param($stmt, "s", $User);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($resultado)) {
            if ($row['cargo'] == "ADMIN") {
                $_SESSION['Admin'] = $User;
                // Atualizar o status do admin para ONLINE
                $Status = "UPDATE admin_func SET estado = 'ONLINE' WHERE email = ?";
                $stmtStatus = mysqli_prepare($GLOBALS['conn'], $Status);
                mysqli_stmt_bind_param($stmtStatus, "s", $User);
                $exec = mysqli_stmt_execute($stmtStatus);
    
                if ($exec) {
                    header('Location: http://localhost/JoelMalacas_FelipeBotelho/paginas/admin.php');
                } else {
                    echo '<script>alert("Erro ao mudar o status para ONLINE.")</script>';
                }
            } else if ($row['cargo'] == "FUNCIONARIO") {
                $_SESSION['Funcionario'] = $User;
                // Atualizar o status do funcionário para ONLINE
                $Status = "UPDATE admin_func SET estado = 'ONLINE' WHERE email = ?";
                $stmtStatus = mysqli_prepare($GLOBALS['conn'], $Status);
                mysqli_stmt_bind_param($stmtStatus, "s", $User);
                $exec = mysqli_stmt_execute($stmtStatus);
    
                if ($exec) {
                    header('Location: http://localhost/JoelMalacas_FelipeBotelho/paginas/funcionario.php');
                } else {
                    echo '<script>alert("Erro ao mudar o status para ONLINE.")</script>';
                }
            }
        }
    }
    $stmt->close();

    // Consulta para verificar se é cliente
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM cliente WHERE email = ? AND password = SHA2(?, 256)");
    $stmt->bind_param("ss", $User, $Pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $estado = null;

        while ($row = mysqli_fetch_assoc($result)) {
            $estado = $row['estado'];
        }

        if ($estado == 'PENDENTE') {
            print '<script>alert("Erro ao tentar iniciar sessão devido ao seu perfil estar pendente\nO administrador precisa de verificar");
                    window.location.href = "http://localhost/JoelMalacas_FelipeBotelho/paginas/login.html";
            </script>';
        } else if ($estado == 'RECUSADO') {
            print '<script>alert("Erro ao tentar iniciar sessão, a sua conta foi rejeitada pelo administrador");
                window.location.href = "http://localhost/JoelMalacas_FelipeBotelho/paginas/login.html";
            </script>';
        } else if ($estado == 'ACEITE') {
            $_SESSION['Cliente'] = $User;
            //Mudar a status para ONLINE
            $Status  =  "UPDATE cliente SET status = 'ONLINE' WHERE email = '$User'";
            $exec = mysqli_query($conn, $Status);
            if ($exec) {
                header('Location: http://localhost/JoelMalacas_FelipeBotelho/paginas/index.php');
            } else {
                print '<script>alert("Erro ao mudar a status para ONLINE")</script>';
            }
        }
    } else {
        echo "<script>
            alert('Credenciais inválidas!!!\\n\\nTente novamente');
            window.location.href = 'http://localhost/JoelMalacas_FelipeBotelho/paginas/login.html';
        </script>";
    }

    $stmt->close();
    $GLOBALS['conn']->close();
?>
