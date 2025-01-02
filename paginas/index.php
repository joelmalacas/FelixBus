<?php
    require '../paginas/scripts/valida.php';
    require '../basedados/basedados.h';

    $User = $_SESSION['Cliente'];
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felix Bus -- Dashboard Cliente</title>
    <link rel="stylesheet" href="../paginas/CSS/admin.css">
    <link rel="shortcut icon" href="../paginas/Media/FelixBusLogo.png" type="image/x-icon">
</head>

<body>
    <div class="sidebar">
        <?php
            $Sql = "SELECT nome FROM cliente WHERE email = '" . $_SESSION['Cliente'] . "'";

            $result = mysqli_query($conn, $Sql);
            
            while ($row = mysqli_fetch_array($result)){
                print "<h1>Olá " . $row['nome']  . " 👋</h1>";   
            }
        ?>
        <form action="" method="post">
            <button type="submit" name="Perfil">Meu perfil 🪪</button>
            <button type="submit" name="Viagens">Viagens 🚍</button>
            <button type="submit" name="Bilhetes">Bilhetes 🎟️</button>
            <button type="submit" name="Depositar">Depositar dinheiro 💰</button>
            <button type="submit" name="Levantar">Levantar dinheiro 💸</button>
            <button type="submit" name="Movimentos">Meus movimentos 🤑</button>
            <button type="submit" name="Logout">Logout 🔌</button>
        </form>
    </div>

    <div class="main-content">
        <!-- Main content // ISSET's -->
        <?php
            $alerta = "SELECT * FROM alerta WHERE estado = 'Visivel'";

            $resultAlert = mysqli_query($conn, $alerta);

            if ($resultAlert && $resultAlert->num_rows > 0) {
                $message = $resultAlert->fetch_assoc();
                print '<div class="alert-header">
                    <span class="alert-icon">'. $message['nomeALERTA'] . ' ⚠️</span>
                    <div class="alert-message">'. $message['descricao'] .'</div>
                </div>';
            }

            if (isset($_POST['Perfil'])) {

                $sql = "SELECT * FROM cliente WHERE email = '$User'";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        print '<div class="profile-form">
                        <form method="post">
                        <h2>Editar Perfil</h2>
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="'. $row['nome'] .'" required>
                            
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="'. $row['email'] .'" readonly>
                            
                            <label for="telefone">Telemóvel</label>
                            <input type="tel" id="telefone" name="telefone" value="'. $row['telemovel']  . '" required>
                            
                            <label for="senha">Palavra-passe</label>
                            <input type="password" id="senha" name="passe" value="" placeholder="Inserir nova palavra-passe">
                            
                            <button type="submit" name="UpdatePerfil">Atualizar Perfil</button>
                            <button type="submit" style="margin-top: 10px">Voltar</button>
                        </form>
                        </div>';
                    }
                }
                mysqli_close($GLOBALS['conn']);
            }

            if (isset($_POST['Levantar'])) {
                print '<div class="profile-form">
                <form id="Update" method="post">
                    <h2>Levantar Dinheiro</h2>
                    <input type="number" id="valor" name="valor" placeholder="Introduza o valor a levantar">
                    <button type="submit" name="LevantarDinheiro">Levantar</button>
                    <button type="submit" style="margin-top: 10px">Voltar</button>
                </form>
                </div>';
            }

            if (isset($_POST['Depositar'])) {
                print '<div class="profile-form">
                <form id="Update" method="post">
                    <h2>Depositar Dinheiro</h2>
                    <input type="number" id="valor" name="valor" placeholder="Introduza o valor a depositar">
                    <button type="submit" name="DepositarDinheiro">Depositar</button>
                    <button type="submit" style="margin-top: 10px">Voltar</button>
                </form>
                </div>';
            }

            if (isset($_POST['Viagens'])) {
                print '<div class="profile-form">
                    <form id="Update" method="post">
                        <h2>Pesquisar Viagens 🚍</h2>
                        <select name="Origem" required>
                            <option value="" disabled selected>Escolha a origem</option>
                            <option value="Lisboa Santa Apolónia">Lisboa Santa Apolónia</option>
                            <option value="Porto">Porto</option>
                            <option value="Coimbra">Coimbra</option>
                            <option value="Faro">Faro</option>
                            <option value="Braga">Braga</option>
                            <option value="Aveiro">Aveiro</option>
                            <option value="Algarve">Algarve</option>
                            <option value="Évora">Évora</option>
                            <option value="Guimarães">Guimarães</option>
                            <option value="Setúbal">Setúbal</option>
                            <option value="Leiria">Leiria</option>
                            <option value="Viseu">Viseu</option>
                        </select>
                        <select name="Destino" required>
                            <option value="" disabled selected>Escolha o destino</option>
                            <option value="Lisboa Santa Apolónia">Lisboa Santa Apolónia</option>
                            <option value="Porto">Porto</option>
                            <option value="Coimbra">Coimbra</option>
                            <option value="Faro">Faro</option>
                            <option value="Braga">Braga</option>
                            <option value="Aveiro">Aveiro</option>
                            <option value="Algarve">Algarve</option>
                            <option value="Évora">Évora</option>
                            <option value="Guimarães">Guimarães</option>
                            <option value="Setúbal">Setúbal</option>
                            <option value="Leiria">Leiria</option>
                            <option value="Viseu">Viseu</option>
                        </select>
                        <button type="submit" name="PesquisaViagens">Pesquisar</button>
                        <button type="submit" style="margin-top: 10px">Voltar</button>
                    </form>
                    </div>';
            }

            if (isset($_POST['Movimentos'])) {
                $sqlUser = "SELECT * FROM cliente WHERE email = '$User'";

                $resultUser = mysqli_query($GLOBALS['conn'], $sqlUser);

                $rowUser = mysqli_fetch_assoc($resultUser);

                $nif = $rowUser['NIF'];

                $sqlMovimentos = "SELECT * FROM transacoes WHERE NIF = '$nif' ORDER BY data_transacao DESC";

                $sqlDinheiro = "SELECT saldo from carteira WHERE NIF = '$nif'";
                $resultDinheiro = mysqli_query($GLOBALS['conn'], $sqlDinheiro);

                $rowDinheiro = mysqli_fetch_assoc($resultDinheiro);

                $resultMovimentos = mysqli_query($GLOBALS['conn'], $sqlMovimentos);

                if ($resultMovimentos) {
                    print '<br><div class="table-container">
                    <h2>Meus Movimentos || Saldo: '. $rowDinheiro['saldo'] . ' €</h2>
                    <table>
                    <thead>
                            <tr>
                                <th>NIF</th>
                                <th>Saldo</th>
                                <th>Transação</th>
                                <th>Data</th>
                            </tr>
                    <thead>
                    <tbody>';
                    while ($rowTransacao = mysqli_fetch_assoc($resultMovimentos)) {
                        print '<tr>
                            <td>'. $rowTransacao['NIF'] .'</td>
                            <td>'. $rowTransacao['saldo'] .'</td>
                            <td>'. $rowTransacao['transacao'] .' €</td>
                            <td>'. $rowTransacao['data_transacao'] .'</td>
                        </tr>';
                    }
                    print '</tbody>
                    </table>
                    </div>';
                }
                mysqli_close($GLOBALS['conn']);
            }
            
            if (isset($_POST['PesquisaViagens'])) {
                $origem = $_POST['Origem'];
                $destino = $_POST['Destino'];

                //Query para listar as viagens pedidas  
                $sql = "SELECT * FROM rotas WHERE origem = '$origem' AND destino = '$destino'";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result && $result->num_rows > 0) {
                    $listaViagensql = "SELECT rotas.id, rotas.origem, rotas.destino, time_rotas.Data_hora AS horario, time_rotas.capacidade 
                    FROM rotas
                    JOIN time_rotas ON rotas.id = time_rotas.id WHERE rotas.origem = '$origem' AND rotas.destino = '$destino'";
                
                    $resultListaViagem = mysqli_query($GLOBALS['conn'], $listaViagensql);
                
                    while ($row = mysqli_fetch_assoc($resultListaViagem)) {
                        print '<div class="card" style="margin-left: calc(50% - 200px);">
                                <h4 class="card-title">De: ' . $row['origem'] . '</h4>
                                <h4 class="card-title">Para: '. $row['destino'] . '</h4>
                                <p class="card-detail"><strong>Lugares:</strong> ' . $row['capacidade'] . '</p>
                                <p class="card-detail"><strong>Data e Hora:</strong> ' . $row['horario'] . '</p>
                                <form method="POST" class="card-form">
                                    <input type="hidden" name="viagem_id" value="' . $row['id'] . '">
                                    <button type="submit" name="CompraBilhete" class="btn">Comprar Bilhete 🎟️</button>
                                </form>
                              </div>';
                    }
                } else {
                    print '<script>alert("Não existem viagens disponíveis para a rota selecionada!")</script>';
                }                

                mysqli_close($GLOBALS['conn']);
            }

            if (isset($_POST['Bilhetes'])) {
                $sqlUser = "SELECT * FROM cliente WHERE email = '$User'";

                $resultUser = mysqli_query($GLOBALS['conn'], $sqlUser);

                $rowUser = mysqli_fetch_assoc($resultUser);

                $id = $rowUser['id'];

                $sqlBilhetes = "SELECT * FROM bilhete WHERE id_cliente = '$id' AND estado = 'Comprado'";
                $resultBilhetes = mysqli_query($GLOBALS['conn'], $sqlBilhetes);
                
                if ($resultBilhetes && $resultBilhetes ->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($resultBilhetes)) {

                        //Obter INFO do ID cliente do bilhete comprado
                        $listaNome = "SELECT * FROM cliente WHERE id = '". $row['id_cliente'] ."'";
                        $resultNome = mysqli_query($GLOBALS['conn'], $listaNome);
                        $rowNome = mysqli_fetch_assoc($resultNome);

                        //Obter INFO da Origem e Destino da Rota
                        $listaRota = "SELECT origem, destino FROM rotas WHERE id = '". $row['id_rota'] ."'";
                        $resultRota = mysqli_query($GLOBALS['conn'], $listaRota);
                        $rowRota = mysqli_fetch_assoc($resultRota);

                        //Obter INFO data e hora
                        $listaDataHora = "SELECT * from time_rotas where id = '". $row['id_rota'] . "';";
                        $resultDataHora = mysqli_query($GLOBALS['conn'], $listaDataHora);
                        $rowDataHora = mysqli_fetch_assoc($resultDataHora);

                        print '<div class="card" style="margin-left: calc(50% - 200px);">
                                <h2 style="text-align: center">Bilhete</h2>
                                <form method="POST" class="card-form">
                                    <h4 class="card-title">ID bilhete: ' . $row['id'] . '</h4>
                                    <h4 class="card-title" name="cliente_id">Cliente: '. $rowNome['nome'] . '</h4>
                                    <p class="card-detail" name="rota_id"><strong>Rota:</strong> ' . $row['id_rota'] . '</p>
                                    <p class="card-detail" name="rota_origem"><strong>Origem:</strong> ' . $rowRota['origem'] . '</p>
                                    <p class="card-detail" name="rota_destino"><strong>Destino:</strong> ' . $rowRota['destino'] . '</p>
                                    <p class="card-detail" name="DataHoraBilhete"><strong>Data:</strong> ' . $rowDataHora['Data_hora'] . '</p>
                                    <p class="card-detail" name="valor"><strong>Valor:</strong> ' . $row['valor'] . ' €</p>
                                    <p class="card-detail" name="EstadoBilhete"><strong>Estado:</strong> ' . $row['estado'] . '</p>
                                    <input type="hidden" name="bilhete_id" value="' . $row['id'] . '">
                                    <input type="submit" name="AnularBilhete" value="Anular" class="btn" style="background-color: red">
                                    <input type="submit" name="" value="Voltar" class="btn">
                                </form>
                              </div>';
                    }
                } else {
                    print '<h1 style="text-align: center">Não existem bilhetes</h1>';
                }
            }

            //ISSET's FORM's
            if (isset($_POST['UpdatePerfil'])) {
                UpdatePerfil();
            }
            if (isset($_POST['DepositarDinheiro'])) {
                Depositar();
            }

            if (isset($_POST['LevantarDinheiro'])) {
                LevantarDinheiro();
            }

            if (isset($_POST['CompraBilhete'])) {
                ComprarBilhete();
            }

            if(isset($_POST['AnularBilhete'])) {
                AnularBilhete();
            }
 
            if (isset($_POST['Logout'])) {
                $Status  =  "UPDATE cliente SET status = 'OFFLINE' WHERE email = '$User'";
                $exec = mysqli_query($GLOBALS['conn'], $Status);
                if ($exec) {
                    require '../paginas/scripts/logout.php';
                }
            }
        ?>
    </div>
</body>

</html>

<?php
function UpdatePerfil() {
    $User = $_SESSION['Cliente'];
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $passe = $_POST['passe'];

    if (empty($passe)) { 
        $sql = "UPDATE cliente SET nome = ?, email = ?, telemovel = ? WHERE email = ?";
        
        $stmt = mysqli_prepare($GLOBALS['conn'], $sql);
        
        mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $telefone, $User);
        
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            echo '<script>alert("Perfil atualizado com sucesso!")</script>';
        } else {
            echo '<script>alert("Erro ao atualizar perfil!")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    } else {
        $hashedPassword = hash('sha256', $passe);
        
        $sql = "UPDATE cliente SET nome = ?, email = ?, telemovel = ?, password = ? WHERE email = ?";
        
        $stmt = mysqli_prepare($GLOBALS['conn'], $sql);
        
        mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $telefone, $hashedPassword, $User);
        
        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            echo '<script>alert("Perfil atualizado com sucesso!");</script>';
        } else {
            echo '<script>alert("Erro ao atualizar perfil!")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }
}

function Depositar() {
    if (empty($_POST['valor']) || $_POST['valor'] == 0) {
        print '<script>alert("Valor não introduzido")</script>';
    } else {
        $valor = $_POST['valor'];

        $listaUser = "SELECT * FROM cliente WHERE email = '" . $_SESSION['Cliente'] . "'";

        $resultListaUser = mysqli_query($GLOBALS['conn'], $listaUser);

        if ($resultListaUser && $row = mysqli_fetch_assoc($resultListaUser)) {
                
                $nif = $row['NIF'];

                //Query para saber e guardar o saldo do utilizador
                $sqlSaldoUser = "SELECT saldo FROM carteira WHERE NIF = '" . $row['NIF'] . "'";

                $resultSaldoUser = mysqli_query($GLOBALS['conn'], $sqlSaldoUser);

                $rowUser = mysqli_fetch_assoc($resultSaldoUser);

                $deposito = $rowUser['saldo'] + $valor;

                $sqlUpdate = "UPDATE carteira SET saldo = '$deposito' WHERE NIF = '$nif'";

                //Insert nas transacoes (LOG Carteira)
                $sqlTransacao = "INSERT INTO transacoes (NIF,saldo,transacao,data_transacao) VALUES ('$nif', $deposito, '+ $valor', CURRENT_TIMESTAMP)";

                $resultTransacao = mysqli_query($GLOBALS['conn'], $sqlTransacao);
                $resultUpdate = mysqli_query($GLOBALS['conn'], $sqlUpdate);

                if ($resultUpdate && $resultTransacao) {
                    print '<script>alert("Depósito efetuado com sucesso!")</script>';
                } else {
                    print '<script>alert("Erro ao efetuar depósito!")</script>';
                }
        }
        mysqli_close($GLOBALS['conn']);
    }
}

function LevantarDinheiro() {
    if (empty($_POST['valor']) || $_POST['valor'] == 0) {
        print '<script>alert("Valor não introduzido")</script>';
    } else {
        $valor = $_POST['valor'];

        $listaUser = "SELECT * FROM cliente WHERE email = '" . $_SESSION['Cliente'] . "'";

        $resultListaUser = mysqli_query($GLOBALS['conn'], $listaUser);

        if ($resultListaUser && $row = mysqli_fetch_assoc($resultListaUser)) {
                
                $nif = $row['NIF'];

                //Query para saber e guardar o saldo do utilizador
                $sqlSaldoUser = "SELECT saldo FROM carteira WHERE NIF = '" . $row['NIF'] . "'";

                $resultSaldoUser = mysqli_query($GLOBALS['conn'], $sqlSaldoUser);

                $rowUser = mysqli_fetch_assoc($resultSaldoUser);

                $deposito = $rowUser['saldo'] - $valor;

                if ($deposito < 0) {
                    print '<script>alert("Saldo insuficiente!")</script>';
                } else {
                    $sqlUpdate = "UPDATE carteira SET saldo = '$deposito' WHERE NIF = '$nif'";

                    //Insert nas transacoes (LOG Carteira)
                    $sqlTransacao = "INSERT INTO transacoes (NIF,saldo,transacao,data_transacao) VALUES ('$nif', $deposito, '- $valor', CURRENT_TIMESTAMP)";

                    $resultTransacao = mysqli_query($GLOBALS['conn'], $sqlTransacao);
                    $resultUpdate = mysqli_query($GLOBALS['conn'], $sqlUpdate);

                    if ($resultUpdate && $resultTransacao) {
                        print '<script>alert("Levantamento efetuado com sucesso!")</script>';
                    } else {
                        print '<script>alert("Erro ao efetuar levantamento!")</script>';
                    }
                }
        }
        mysqli_close($GLOBALS['conn']);
    }
}

function ComprarBilhete() {

    /*
        Condição saldo do cliente
        Obter o ID da viagem desejado
        Obter o NIF do cliente para a transação e atualizar o saldo consoante o valor do bilhete
        Atualizar a capacidade da viagem
        Inserir na tabela de bilhetes o id_transacao, id_cliente, id_rota, o valor do bilhete e o estado do bilhete (comprado)
        Colocar o dinheiro retirado do saldo do cliente para o Administrador
    */ 

    $sqlUser = "SELECT * FROM cliente WHERE email = '" . $_SESSION['Cliente'] . "'";

    $resultUser = mysqli_query($GLOBALS['conn'], $sqlUser);

    $rowUser = mysqli_fetch_assoc($resultUser);

    //NIF e ID do Cliente
    $nif = $rowUser['NIF'];
    $idCliente = $rowUser['id'];
    //ID da viagem a pagar
    $id = $_POST['viagem_id'];

    //Valor bilhete (Random entre 7 e 20, devido a falha na BD)
    $valorBilhete = rand(7, 20);

    //Obter saldo do cliente
    $sqlSaldo = "SELECT saldo FROM carteira WHERE NIF = '$nif'";
    $resultSaldo = mysqli_query($GLOBALS['conn'], $sqlSaldo);

    $rowSaldo = mysqli_fetch_assoc($resultSaldo);

    //Obter a capacidade da viagem e confirmar se ainda existem lugares
    $sqlCapacidade = "SELECT capacidade FROM time_rotas WHERE id = '$id'";
    $resultCapacidade = mysqli_query($GLOBALS['conn'], $sqlCapacidade);

    $rowCapacidade = mysqli_fetch_assoc($resultCapacidade);

    if ($rowCapacidade['capacidade'] <= 0) {
        print '<script>alert("Não há lugares disponíveis na viagem!")</script>';
    } else if ($rowSaldo['saldo'] < $valorBilhete) {
        print '<script>alert("Saldo insuficiente!!!\nDeposite dinheiro na carteira para poder comprar")</script>';
    } else {

        $saldo = $rowSaldo['saldo'] - $valorBilhete;

        mysqli_begin_transaction($GLOBALS['conn']); //Segurança || começa a gravar as alterações na base de dados

        try {
            // Atualizar saldo do cliente
            $sqlUpdateSaldo = "UPDATE carteira SET saldo = '$saldo' WHERE NIF = '$nif'";
            mysqli_query($GLOBALS['conn'], $sqlUpdateSaldo);

            // Atualizar saldo do administrador
            $sqlUpdateAdmin = "UPDATE carteira SET saldo = saldo + $valorBilhete WHERE NIF = '524801766'";
            mysqli_query($GLOBALS['conn'], $sqlUpdateAdmin);

            //Listagem do saldo atualizado do ADMIN
            $ListaSaldoAdmin = "SELECT saldo FROM carteira WHERE NIF = '524801766'";

            $resultSaldoAdmin = mysqli_query($GLOBALS['conn'], $ListaSaldoAdmin);
            $rowSaldoAdmin = mysqli_fetch_assoc($resultSaldoAdmin);
            $saldoAdmin = $rowSaldoAdmin['saldo'];

            // Atualizar capacidade da viagem
            $sqlUpdateCapacidade = "UPDATE time_rotas SET capacidade = capacidade - 1 WHERE id = '$id'";
            mysqli_query($GLOBALS['conn'], $sqlUpdateCapacidade);

            // Inserir transação do utilizador para o log carteira
            $sqlTransacaoUser = "INSERT INTO transacoes (NIF, saldo, transacao, data_transacao) VALUES ('$nif', $saldo, '- $valorBilhete', CURRENT_TIMESTAMP)";
            mysqli_query($GLOBALS['conn'], $sqlTransacaoUser);

            // Inserir transação do administrador
            $sqlTransacaoAdmin = "INSERT INTO transacoes (NIF, saldo, transacao, data_transacao) VALUES ('524801766', $saldoAdmin, '+ $valorBilhete', CURRENT_TIMESTAMP)";
            mysqli_query($GLOBALS['conn'], $sqlTransacaoAdmin);

            // Obter o último ID inserido na tabela transacoes
            $id_transacao = mysqli_insert_id($GLOBALS['conn']);

            // Inserir na tabela bilhete
            $sqlBilhete = "INSERT INTO bilhete (id_transacao, id_cliente, id_rota, valor, estado) VALUES ('$id_transacao', '$idCliente', '$id', '$valorBilhete', 'Comprado')";
            mysqli_query($GLOBALS['conn'], $sqlBilhete);

            // Confirmar transação
            mysqli_commit($GLOBALS['conn']);
            print '<script>alert("Bilhete comprado com sucesso!")</script>';
        } catch (Exception $e) {
            mysqli_rollback($GLOBALS['conn']); // Reverter alterações em caso de erro
            print '<script>alert("Erro ao comprar bilhete! Por favor, tente novamente.")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }
}

function AnularBilhete() {

    /*
        Reverter a transação do bilhete:
        Obter o ID do bilhete a ser anulado
        Verificar se o bilhete existe e está no estado "Comprado"
        Restaurar o saldo do cliente
        Diminuir o saldo do administrador
        Restaurar a capacidade da viagem
        Alterar o estado do bilhete para "Anulado"
        Registrar as alterações no log de transações
    */

    // ID do bilhete a anular
    $idBilhete = $_POST['bilhete_id'];

    mysqli_begin_transaction($GLOBALS['conn']); //Segurança || começa a gravar as alterações na base de dados

    try {
        // Obter informações do bilhete
        $sqlBilhete = "SELECT * FROM bilhete WHERE id = '$idBilhete' AND estado = 'Comprado'";
        $resultBilhete = mysqli_query($GLOBALS['conn'], $sqlBilhete);

        $rowBilhete = mysqli_fetch_assoc($resultBilhete);
        $idCliente = $rowBilhete['id_cliente'];
        $idRota = $rowBilhete['id_rota'];
        $valorBilhete = $rowBilhete['valor'];

        // Obter NIF do cliente
        $sqlCliente = "SELECT * FROM cliente WHERE id = '$idCliente'";
        $resultCliente = mysqli_query($GLOBALS['conn'], $sqlCliente);

        $rowCliente = mysqli_fetch_assoc($resultCliente);
        $nifCliente = $rowCliente['NIF'];

        // Restaurar saldo do cliente
        $sqlUpdateSaldoCliente = "UPDATE carteira SET saldo = saldo + $valorBilhete WHERE NIF = '$nifCliente'";
        mysqli_query($GLOBALS['conn'], $sqlUpdateSaldoCliente);

        // Diminuir saldo do administrador
        $sqlUpdateSaldoAdmin = "UPDATE carteira SET saldo = saldo - $valorBilhete WHERE NIF = '524801766'";
        mysqli_query($GLOBALS['conn'], $sqlUpdateSaldoAdmin);

        // Restaurar capacidade da viagem
        $sqlUpdateCapacidade = "UPDATE time_rotas SET capacidade = capacidade + 1 WHERE id = '$idRota'";
        mysqli_query($GLOBALS['conn'], $sqlUpdateCapacidade);

        // Alterar estado do bilhete para "Anulado"
        $sqlUpdateEstadoBilhete = "UPDATE bilhete SET estado = 'Anulado' WHERE id = '$idBilhete'";
        mysqli_query($GLOBALS['conn'], $sqlUpdateEstadoBilhete);

        // Registrar transação de anulação do cliente
        $sqlTransacaoCliente = "INSERT INTO transacoes (NIF, saldo, transacao, data_transacao) 
                                VALUES ('$nifCliente', (SELECT saldo FROM carteira WHERE NIF = '$nifCliente'), '+ $valorBilhete', CURRENT_TIMESTAMP)";
        mysqli_query($GLOBALS['conn'], $sqlTransacaoCliente);

        // Registrar transação de anulação do administrador
        $sqlTransacaoAdmin = "INSERT INTO transacoes (NIF, saldo, transacao, data_transacao) 
                              VALUES ('524801766', (SELECT saldo FROM carteira WHERE NIF = '524801766'), '- $valorBilhete', CURRENT_TIMESTAMP)";
        mysqli_query($GLOBALS['conn'], $sqlTransacaoAdmin);

        // Confirmar transação
        mysqli_commit($GLOBALS['conn']);

        print '<script>alert("Bilhete anulado com sucesso!")</script>';
    } catch (Exception $e) {
        // Reverter alterações em caso de erro
        mysqli_rollback($GLOBALS['conn']);
        print '<script>alert("Erro ao anular bilhete! Por favor, tente novamente.")</script>';
    }
    
    mysqli_close($GLOBALS['conn']);
}
?>