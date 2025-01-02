<?php
    require '../paginas/scripts/validaAdmin.php';
    require '../basedados/basedados.h';
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felix Bus -- Admin Dashboard</title>
    <link rel="stylesheet" href="../paginas/CSS/admin.css">
    <link rel="shortcut icon" href="../paginas/Media/FelixBusLogo.png" type="image/x-icon">
</head>
<body>
<div class="sidebar">
    <h1>👋 Administrador</h1>
    <form action="" method="post">
        <button type="submit" name="Perfil">Meu perfil 🪪</button>
        <button type="submit" name="Movimentos">Movimentos 💰</button>
        <button type="submit" name="ListRotas">Listar Rotas 🛣️</button>
        <button type="submit" name="ListHorario">Listar Horários ⏳</button>
        <button type="submit" name="ListUser">Listar Utilizadores ♟️</button>
        <button type="submit" name="ListFunc">Listar Funcionários 👨‍💼</button>
        <button type="submit" name="ListAlert">Listar Alertas 🚨</button>
        <button type="submit" name="CreateRotas">Criar Rotas 🛣️</button>
        <button type="submit" name="CreateAlertas">Criar Alertas 🚨</button>
        <button type="submit" name="CreateUser">Criar Utilizador ♟️</button>
        <button type="submit" name="CreateFUNC">Criar Funcionários 👨‍💼</button>
        <button type="submit" name="VerifiCUser">Verificar Utilizadores ♟️</button>
        <button type="submit" name="AlterAlerta">Editar Alerta 🚨</button>
        <button type="submit" name="AlterRota">Editar Rota 🛣️</button>
        <button type="submit" name="DelRota">Apagar Rota 🛣️</button>
        <button type="submit" name="DelUser">Apagar Utilizador ♟️</button>
        <button type="submit" name="DelAlerta">Apagar Alerta 🚨</button>
        <button type="submit" name="DelFUNC">Apagar Funcionário 👨‍💼</button>
        <button type="submit" name="Logout">Logout 🔌</button>
    </form>
</div>

    <div class="main-content">
        <!-- Main content // ADD PHP ISSET's -->
         <?php
        //isset's buttons
            if (isset($_POST['ListRotas'])) {
               ListRotas();
            }
            if (isset($_POST['ListUser'])) {
                ListUser();
            }
            if (isset($_POST['ListFunc'])){
                ListFunc();
            }
            if (isset($_POST['ListHorario'])) {
                ListHorario();
            }
            if (isset($_POST['ListAlert'])) {
                ListAlert();
            }
            if(isset($_POST['MovimentosUser'])){
                MovimentosUser();
            }
            if (isset($_POST['Perfil'])) {
                $sql = "SELECT * FROM admin_func WHERE cargo = 'ADMIN'";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                $row = mysqli_fetch_assoc($result);

                print '<div class="profile-form">
                        <form method="post">
                        <h2>Editar Perfil</h2>
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" value="'. $row['nome'] .'" readonly>
                            
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="'. $row['email'] .'" readonly>
                            
                            <label for="nif">NIF</label>
                            <input type="text" id="nif" name="nif" value="'. $row['NIF'] . '" readonly>
                            
                            <button type="submit" style="margin-top: 10px">Voltar</button>
                        </form>
                        </div>';
                mysqli_close($GLOBALS['conn']);
            }
            if (isset($_POST['VerifiCUser'])) {
                print '<form id="Update" method="post">
                    <input type="email" name="EmailClienteUpdate" placeholder="Introduza e-mail do cliente" required>
                    <select name="EstadoUpdate" required>
                        <option value="" disabled SELECTED>Verificar utilizador</option>
                        <option value="ACEITE">Aceite</option>
                        <option value="PENDENTE">Pendente</option>
                        <option value="RECUSADO">Recusado</option>
                    </select>
                    <input type="submit" name="UserUpdate" value="Guardar Alterações">
                </form><br>';

                print '<div class="table-container">
                <h2>Utilizadores pendentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>NIF</th>
                            <th>telemovel</th>
                            <th>Estado Perfil</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>';

                $sql = "SELECT * FROM cliente WHERE estado='PENDENTE'";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result && $result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        print "<tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['NIF'] . "</td>
                        <td>" . $row['telemovel'] . "</td>
                        <td>" . $row['estado'] . "</td>
                        <td>" . $row['status'] . "</td>";
                        print "</tr>";
                    }
                } else {
                    print '<td>Não foi encontrado nenhum utilizador pendente</td>';
                }
                mysqli_close($GLOBALS['conn']);
            }
            if (isset($_POST['UserUpdate'])) { //Isset para o form Verifica User
                VerificaUser();
            }
            if(isset($_POST['CreateRotas'])) {
                ?>
                    <form method="post" id="Rota">
                        <h2>Criar Rota</h2>
                        <select name="Origem" required>
                            <option value="default">Escolha a origem</option>
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
                            <option value="default">Escolha o destino</option>
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
                        <input type="datetime-local" name="data_hora" placeholder="Introduza data e hora" required>
                        <input type="number" name="Capacidade" min="1" max="70" placeholder="Introduz a capacidade" required>
                        <input type="submit" name="CriaRota" value="Criar Rota">
                    </form>
                <?php
            }
            if (isset($_POST['CriaRota'])) { // ISSET do form acima
                CriarRotas();
            }
            if (isset($_POST['CreateAlertas'])){
                ?>
                        <form method="post" id="Rota">
                            <h2>Criar Alerta</h2>
                            <input type="text" name="NomeAlerta" placeholder="Introduza nome do Alerta" required>
                            <textarea name="DescAlerta" placeholder="Introduza descrição do alerta" required></textarea>
                            <select name="EstadoAlerta" required>
                                <option value="" disabled selected>Selecione o estado</option>
                                <option value="Visivel">Visível</option>
                                <option value="Invisivel">Invisível</option>
                            </select>
                            <input type="submit" name="SubAlerta" value="Criar Alerta">
                        </form>
                <?php
            }
            if (isset($_POST['SubAlerta'])) {
                CriarAlerta();
            }
            if (isset($_POST['CreateUser'])) {
                ?>
                    <form id="Rota" method="post">
                        <h2>Criar utilizador</h2>
                        <input type="text" name="Nome" placeholder="Introduza nome" required>
                        <input type="email" name="Email" placeholder="Introduza e-mail" required>
                        <input type="password" name="Passe" placeholder="Introduza password" required>
                        <input type="number" name="NIF" maxlength="9" placeholder="Introduza NIF">
                        <input type="tel" name="telemovel" placeholder="Introduza número telemóvel" required>
                        <input type="submit" name="CriarUser" value="Criar Utilizador">
                    </form>
                <?php
            }
            if (isset($_POST['CriarUser'])) {
                CriarUser();
            }
            if (isset($_POST['CreateFUNC'])) {
                ?>
                    <form id="Rota" method="post">
                        <h2>Criar Funcionário</h2>
                        <input type="text" name="nome" placeholder="Introduza nome do funcionário" required>
                        <input type="email" name="email" placeholder="Introduza e-mail do funcionário" required>
                        <input type="password" name="passe" placeholder="Introduza password para funcionário" required>
                        <input type="number" name="NIF" placeholder="Introduza NIF do funcionário" required>
                        <input type="submit" name="SubFunc" value="Criar funcionário">
                    </form>
                <?php
            }
            if (isset($_POST['SubFunc'])) {
                CriarFunc();
            }
                //Isset Pesquisa
            if (isset($_POST['PesquisaSub'])) {
                PesquisaUser();
            }
            if (isset($_POST['AlterAlerta'])) {
                print '<form id="Update" method="post">
                    <input type="text" name="NomeAlerta" placeholder="Introduza nome do alerta" required>
                    <select name="EstadoAlerta" required>
                        <option value="" disabled SELECTED>Alterar estado</option>
                        <option value="Visivel">Visivel</option>
                        <option value="Invisivel">Invisivel</option>
                    </select>
                    <input type="submit" name="AlertaUpdate" value="Guardar Alterações">
                </form><br>';

                print '<div class="table-container">
                <h2>Alertas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome Alerta</th>
                            <th>Descrição</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>';

                $sql = "SELECT * FROM alerta";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result && $result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        print "<tr>
                        <td>" . $row['nomeALERTA'] . "</td>
                        <td>" . $row['descricao'] . "</td>
                        <td>" . $row['estado'] . "</td>";
                        print "</tr>";
                    }
                } else {
                    print '<td>Não foi encontrado nenhum alerta</td>';
                }
                mysqli_close($GLOBALS['conn']);
            }
            //ISSET do Submit Alerta Update
            if (isset($_POST['AlertaUpdate'])) {
                AlertaUpdate();
            }
            if (isset($_POST['DelRota'])) {
                ?>
                    <form id="Update" action="" method="post">
                        <h3>Apagar Rota</h3>
                        <input type="number" name="IDRota" placeholder="Introduza o ID da rota" required>
                        <input type="submit" name="DelRotaConfirma" value="Confirmar">
                    </form>
                <?php

                //Tabela
                print '<br><div class="table-container">
                <h2>Rotas FelixBus 🛣️</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID 🪪</th>
                            <th>Origem 🛫</th>
                            <th>Destino 🛬</th>
                            <th>Data/Hora ⏰</th>
                            <th>Capacidade 🚃</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                    $sql = "SELECT rotas.id, rotas.origem, rotas.destino, time_rotas.Data_hora AS horario, time_rotas.capacidade 
                    FROM rotas
                    JOIN time_rotas ON rotas.id = time_rotas.id";
            
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['origem'] . "</td>
                                    <td>" . $row['destino'] . "</td>
                                    <td>" . $row['horario'] . "</td>
                                    <td>" . $row['capacidade'] . "</td>
                                </tr>";
                        }
                    } else {
                        print "<tr><td colspan='4'>Nenhuma rota encontrada</td></tr>";
                    }
                    
                    print '</tbody>
                        </table>
                        </div>';
                    
                    mysqli_close($GLOBALS['conn']);
            }
            //Isset's DelRota
            if (isset($_POST['DelRotaConfirma'])) {
                DelRota();
            }
            if (isset($_POST['AlterRota'])) {
                ?>
                    <form id="Update" action="" method="post">
                        <h3>Editar Rota</h3>
                        <input type="number" name="IDRota" placeholder="Introduza o ID da rota" required>
                        <input type="submit" name="EditConfRota" value="Confirmar">
                    </form>
                <?php

                //Tabela
                print '<br><div class="table-container">
                <h2>Rotas FelixBus 🛣️</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID 🪪</th>
                            <th>Origem 🛫</th>
                            <th>Destino 🛬</th>
                            <th>Data/Hora ⏰</th>
                            <th>Capacidade 🚃</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                    $sql = "SELECT rotas.id, rotas.origem, rotas.destino, time_rotas.Data_hora AS horario, time_rotas.capacidade 
                    FROM rotas
                    JOIN time_rotas ON rotas.id = time_rotas.id";
            
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['origem'] . "</td>
                                    <td>" . $row['destino'] . "</td>
                                    <td>" . $row['horario'] . "</td>
                                    <td>" . $row['capacidade'] . "</td>
                                </tr>";
                        }
                    } else {
                        print "<tr><td colspan='4'>Nenhuma rota encontrada</td></tr>";
                    }
                    
                    print '</tbody>
                        </table>
                        </div>';
                    
                    mysqli_close($GLOBALS['conn']);
            }
            if (isset($_POST['EditConfRota'])) {
                EditRota();
            }
            //ISSET's UpdateRota
            if (isset($_POST['EditRota'])) {
                UpdateRota();
            }
            if (isset($_POST['DelUser'])) {
                ?>
                    <form id="Update" action="" method="post">
                        <h3>Apagar Utilizador</h3>
                        <input type="email" name="EmailUser" placeholder="Introduza o e-mail do utilizador" required>
                        <input type="submit" name="DelUserConfirma" value="Confirmar">
                    </form>
                <?php

                //Tabela
                print '<br><div class="table-container">
                <h2>Utilizadores FelixBus ♟️</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>NIF</th>
                            <th>telemovel</th>
                            <th>Estado Perfil</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>';
        
                    $sql = "SELECT * FROM cliente";
            
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>
                                    <td>" . $row['nome'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['NIF'] . "</td>
                                    <td>" . $row['telemovel'] . "</td>
                                    <td>" . $row['estado'] . "</td>";
                                    if ($row['status'] == "ONLINE") {
                                        print "<td>" . $row['status'] . " 🟢</td>";
                                    } else {
                                        print "<td>" . $row['status'] . " 🔴</td>";
                                    }
                                print "</tr>";
                        }
                    } else {
                        print "<tr><td colspan='4'>Nenhum utilizador encontrado</td></tr>";
                    }
                    
                    print '</tbody>
                        </table>
                        </div>';
                    
                    mysqli_close($GLOBALS['conn']);
            }
            if (isset($_POST['DelUserConfirma'])) {
                DelUser();
            }
            if (isset($_POST['DelAlerta'])) {
                print '<form id="Update" method="post">
                    <h3>Apagar Alerta</h3>
                    <input type="text" name="NomeAlerta" placeholder="Introduza nome do alerta" required>
                    <input type="submit" name="AlertaDelete" value="Guardar Alterações">
                </form><br>';

                print '<div class="table-container">
                <h2>Alertas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome Alerta</th>
                            <th>Descrição</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>';

                $sql = "SELECT * FROM alerta";

                $result = mysqli_query($GLOBALS['conn'], $sql);

                if ($result && $result->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        print "<tr>
                        <td>" . $row['nomeALERTA'] . "</td>
                        <td>" . $row['descricao'] . "</td>
                        <td>" . $row['estado'] . "</td>";
                        print "</tr>";
                    }
                } else {
                    print '<td>Não foi encontrado nenhum alerta</td>';
                }
                mysqli_close($GLOBALS['conn']);
            }
            if(isset($_POST['AlertaDelete'])) {
                DelAlerta();
            }
            if (isset($_POST['DelFUNC'])) {
                ?>
                    <form id="Update" action="" method="post">
                        <h3>Apagar Funcionário</h3>
                        <input type="email" name="NomeFunc" placeholder="Introduza email do funcionário" required>
                        <input type="submit" name="DelFuncConfirma" value="Confirmar">
                    </form>
                <?php
                    //Tabela
                    print '<br><div class="table-container">
                    <h2>Funcionários FelixBus 👨‍💼</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>NIF</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>';
        
                    $sql = "SELECT * FROM admin_func WHERE cargo = 'FUNCIONARIO'";
            
                    $result = mysqli_query($GLOBALS['conn'], $sql);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>
                                    <td>" . $row['nome'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['NIF'] . "</td>";
                                    if ($row['estado'] == "ONLINE") {
                                        print "<td>" . $row['estado'] . " 🟢</td>";
                                    } else {
                                        print "<td>" . $row['estado'] . " 🔴</td>";
                                    }
                                print "</tr>";
                        }
                    } else {
                        print "<tr><td colspan='4'>Nenhum funcionário encontrado</td></tr>";
                    }
                    
                    print '</tbody>
                        </table>
                        </div>';
                    
                    mysqli_close($GLOBALS['conn']);
            }
            if (isset($_POST['DelFuncConfirma'])) {
                DelFunc();
            }
            if (isset($_POST['Movimentos'])) {
                //Tabela
                print '<br><div class="table-container">
                <h2>Movimentos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>NIF</th>
                            <th>Saldo</th>
                            <th>Transação</th>
                            <th>Data Transação</th>
                        </tr>
                    </thead>
                    <tbody>';

                    $sql = "SELECT * from transacoes WHERE NIF = '524801766' ORDER BY data_transacao DESC; "; //Consulta com o NIF "524801766" específico do ADMIN

                    $result = mysqli_query($GLOBALS['conn'], $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            print "<tr>
                                    <td>" . $row['NIF'] . "</td>
                                    <td>" . $row['saldo'] . "</td>
                                    <td>" . $row['transacao'] . "</td>
                                    <td>" . $row['data_transacao'] . "</td>
                                    </tr>
                                </tbody>";
                        }
                    } else {
                        print "<tr><td colspan='4'>Nenhuma transação efetuada</td></tr>";
                    }
            }
            if (isset($_POST['Logout'])) {
                $Admin = $_SESSION['Admin'];
                $Status  =  "UPDATE admin_func SET estado = 'OFFLINE' WHERE email = '$Admin'";
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
    //Functions Buttons

    function ListRotas() {
        //Tabela
        print '<div class="table-container">
        <h2>Rotas FelixBus</h2>
        <table>
            <thead>
                <tr>
                    <th>Origem 🛫</th>
                    <th>Destino 🛬</th>
                </tr>
            </thead>
            <tbody>';
 
        $sql = "SELECT * FROM rotas";
        $result = mysqli_query($GLOBALS['conn'], $sql);
              
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                print "<tr>
                  <td>" . $row['origem'] . "</td>
                  <td>" . $row['destino'] . "</td>";
                print "</tr>";
            }
        } else {
            print '<td>Nenhuma rota encontrada</td>';
        }
        print '</tbody>
        </table>
        </div>';
        mysqli_close($GLOBALS['conn']);
    }

    function ListUser() {
        //tabela
        print '<div class="input-container">
            <form method="post">
                <input type="search" id="searchInput" name="PesquisaUser" placeholder="Pesquisar utilizador" required>
                <input type="submit" id="searchButton" name="PesquisaSub" value="Pesquisar">
            </form>
            </div>
            ';
        print '<div class="table-container">
        <h2>Lista Utilizadores</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>NIF</th>
                    <th>telemovel</th>
                    <th>Estado Perfil</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>';
        $User = "SELECT * FROM cliente";

        $result = mysqli_query($GLOBALS['conn'],$User);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                print "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['NIF'] . "</td>
                <td>" . $row['telemovel'] . "</td>
                <td>" . $row['estado'] . "</td>";
                if ($row['status'] == "ONLINE") {
                    print "<td>" . $row['status'] . " 🟢</td>";
                } else {
                    print "<td>" . $row['status'] . " 🔴</td>";
                }
                print "</tr>";
            }
        } else {
            print "<td>Não foi encontrado nenhum utilizador</td>";
        }
        print '</tbody>
        </table>
        </div>';
        mysqli_close($GLOBALS['conn']);
    }

    function ListFunc() {
        //tabela
        print '<div class="table-container">
        <h2>Lista Funcionários</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>email</th>
                    <th>NIF</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
        $func = "SELECT * FROM admin_func WHERE cargo = 'FUNCIONARIO';";

        $result = mysqli_query($GLOBALS['conn'], $func);

        if ($result && $result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                print "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['NIF'] . "</td>";
                
                if ($row['estado'] == "ONLINE") {
                    print "<td>" . $row['estado'] . " 🟢</td>";
                } else {
                    print "<td>" . $row['estado'] . " 🔴</td>";
                }

                print "</tr>";
            }
        } else {
            print "<td>Nenhum funcionário encontrado</td>";
        }
        print '</tbody>
        </table>
        </div>';
        mysqli_close($GLOBALS['conn']);
    }

    function ListHorario() {
        //tabela
        print '<div class="table-container">
        <h2>Lista Horário</h2>
        <table>
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Capacidade</th>
                </tr>
            </thead>
            <tbody>';

        $horario = "SELECT * FROM time_rotas";

        $result = mysqli_query($GLOBALS['conn'], $horario);

        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                print "<tr>
                <td>" . $row['Data_hora'] . "</td>
                <td>" . $row['capacidade'] . " Lugares</td>";
                print "</tr>";
            }
        } else {
            print "<td>Nenhum horário encontrado</td>";
        }
        mysqli_close($GLOBALS['conn']);
    }

    function ListAlert() {
        //tabela
        print '<div class="table-container">
        <h2>Lista Alertas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome Alerta</th>
                    <th>Descrição</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>';

        $Alerta = "SELECT * FROM alerta";

        $result = mysqli_query($GLOBALS['conn'],$Alerta);

        if ($result && $result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                print "<tr>
                <td>" . $row['nomeALERTA'] . "</td>
                <td>" . $row['descricao'] . "</td>
                <td>" . $row['estado'] . "</td>";
                print "</tr>";
            }
        } else {
            print "<td>Nenhum alerta encontrado</td>";
        }
        print '</tbody>
        </table>
        </div>';

        mysqli_close($GLOBALS['conn']);
    }

    function VerificaUser() {
        $email = $_POST['EmailClienteUpdate'];
        $estado = $_POST['EstadoUpdate'];

        $sql = "UPDATE cliente SET estado='$estado' WHERE email='$email'";

        $result = mysqli_query($GLOBALS['conn'], $sql);

        if ($result) {
            print '<script>alert("Estado do Cliente atualizado com sucesso!!!")</script>';
        } else {
            print '<script>alert("Erro ao atualizar cliente")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }

    function CriarRotas() {
        $Origem = $_POST['Origem'];
        $Destino = $_POST['Destino'];
        $Data_hora = $_POST['data_hora'];
        $Capacidade = $_POST['Capacidade'];
    
        $Rota = "INSERT INTO rotas (origem, destino) VALUES ('$Origem', '$Destino')";
        
        $resultRota = mysqli_query($GLOBALS['conn'], $Rota);
    
        if ($resultRota) {
            // Recupera o último ID insert
            $id = mysqli_insert_id($GLOBALS['conn']);
        
            // Ajusta o formato de Data_hora para YYYY-MM-DD HH:MM:SS
            $Data_hora = str_replace('T', ' ', $Data_hora);
        
            // Query para inserir no time_rotas
            $time_rota = "INSERT INTO time_rotas (id, Data_hora, capacidade) VALUES ($id, '$Data_hora', '$Capacidade')";
            $resultTime_rota = mysqli_query($GLOBALS['conn'], $time_rota);
        
            if ($resultTime_rota) {
                print '<script>alert("Rota criada com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao criar time da rota. Tente novamente!!!")</script>';
            }
        } else {
            print '<script>alert("Erro ao criar rota. Tente novamente!!!")</script>';
        }
    
        mysqli_close($GLOBALS['conn']);
    }
    
    function CriarAlerta() {
        //Cria Alerta e colocar na BD
        $nomeAlerta = $_POST['NomeAlerta'];
        $descAlerta = $_POST['DescAlerta'];
        $estadoAlerta = $_POST['EstadoAlerta'];

        $sql = "INSERT INTO alerta (nomeAlerta, descricao, estado) VALUES ('$nomeAlerta', '$descAlerta', '$estadoAlerta')";

        $result = mysqli_query($GLOBALS['conn'], $sql);

        if ($result) {
            print '<script>alert("Alerta criado com sucesso")</script>';
        } else {
            print '<script>alert("Erro ao criar alerta\nTente novamente")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }
    
    function CriarUser() {
        $nome = $_POST['Nome'];
        $Passe = $_POST['Passe'];
        $Email = $_POST['Email'];
        $Nif = $_POST['NIF'];
        $telemovel = $_POST['telemovel'];

        $verifica = "SELECT * FROM cliente WHERE email = '$Email'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if (mysqli_num_rows($resultVerifica) == 0) {
            $sql = "INSERT INTO cliente (nome, password, email, NIF, telemovel, estado, status) VALUES ('$nome', SHA2('$Passe', 256), '$Email', '$Nif', '$telemovel', 'PENDENTE', 'OFFLINE')";
            
            $id = mysqli_insert_id($GLOBALS['conn']);

            $sqlCarteira = "INSERT INTO carteira (id, NIF, saldo) VALUES ($id, '$Nif', 0.0)";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            $resultCarteira = mysqli_query($GLOBALS['conn'], $sqlCarteira);

            if ($result && $resultCarteira) {
                print '<script>alert("Utilizador criado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Ocorreu um erro ao tentar criar o utilizador!!!")</script>';
            }
        } else {
            print '<script>alert("Já existe um utilizador com este email!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }

    function CriarFunc() {
        $nome = $_POST['nome'];
        $Email = $_POST['email'];
        $Passe = $_POST['passe'];
        $Nif = $_POST['NIF'];

        $PasseHash = hash('sha256', $Passe);

        $verifica = "SELECT * FROM admin_func WHERE email = '$Email'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica -> num_rows == 0) {
            $sql = "INSERT INTO admin_func (nome,email,password,estado,cargo,NIF) VALUES ('$nome', '$Email', '$PasseHash', 'OFFLINE', 'FUNCIONARIO', '$Nif')";

            $carteira = "INSERT INTO carteira (NIF, saldo) VALUES ('$Nif', 0.0)";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            $resultCarteira = mysqli_query($GLOBALS['conn'], $carteira);

            if ($result && $resultCarteira) {
                print '<script>alert("Funcionário criado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Ocorreu um erro ao tentar criar o funcionário\nTente novamente!!!")</script>';
            }
        } else {
            print '<script>alert("Já existe um funcionário com este email!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }

    function PesquisaUser() {
        //Pesquisar utilizador e mostrar info DB
        $Pesquisa = $_POST['PesquisaUser'];

        $sql = "SELECT * FROM cliente WHERE email = '$Pesquisa'";

        $result = mysqli_query($GLOBALS['conn'], $sql);

        if ($result -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nif = $row['NIF'];

                $sqlCarteira = "SELECT * FROM carteira WHERE NIF = '$nif'";

                $resultCarteira = mysqli_query($GLOBALS['conn'], $sqlCarteira);

                $rowCarteira = $resultCarteira->fetch_assoc();

                if ($resultCarteira) {
                    ?>
                    <div class="form-container">
                        <form method="POST">
                            <table>
                                <thead>
                                    <h2>Perfil <?php echo ($row['nome']); ?></h2>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><label for="nome">Nome</label></td>
                                        <td><input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="email">E-mail</label></td>
                                        <td><input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="nif">NIF</label></td>
                                        <td><input type="text" id="nif" name="nif" value="<?php echo $row['NIF']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="telemovel">Telemóvel</label></td>
                                        <td><input type="text" id="telemovel" name="telemovel" value="<?php echo $row['telemovel']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="saldo">Saldo Carteira</label></td>
                                        <td><input type="text" id="saldo" name="saldo" value="<?php echo $rowCarteira['saldo']; ?> €" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="estado">Estado Perfil</label></td>
                                        <td><input type="text" id="estado" name="estado" value="<?php echo $row['estado']; ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td><label for="status">Status</label></td>
                                        <td><input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="submit" value="Mostrar Movimentos" name="MovimentosUser">
                            <input type="submit" value="Voltar">
                        </form>
                    </div>

                    <?php
                }
            }
        } else {
            print '<script>alert("Utilizador não encontrado!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }

    function MovimentosUser() {
        //Mostrar movimentos de um utilizador
        $NIF = $_POST['nif'];

        $sqlMovimentos = "SELECT * FROM transacoes WHERE NIF = '$NIF'";

        $sqlDinheiro = "SELECT saldo from carteira WHERE NIF = '$NIF'";
        $resultDinheiro = mysqli_query($GLOBALS['conn'], $sqlDinheiro);

        $rowDinheiro = mysqli_fetch_assoc($resultDinheiro);

        $resultMovimentos = mysqli_query($GLOBALS['conn'], $sqlMovimentos);

        if ($resultMovimentos) {
            print '<br><div class="table-container">
            <h2>Movimentos de: '. $_POST['nome'] . ' || Saldo: '. $rowDinheiro['saldo'] . ' €</h2>
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

    function AlertaUpdate() {
        $nomeAlerta = $_POST['NomeAlerta'];
        $estadoAlerta = $_POST['EstadoAlerta'];

        $verifica = "SELECT * FROM alerta WHERE nomeALERTA = '$nomeAlerta'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica && $resultVerifica->num_rows == 0) {
            print '<script>alert("Alerta não encontrado!!!")</script>';
        } else {
            $sql = "UPDATE alerta SET estado='$estadoAlerta' WHERE nomeALERTA='$nomeAlerta'";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            if($result) {
                print '<script>alert("Alerta alterado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao alterar alerta\nTente novamente")</script>';
            }
        }
        mysqli_close($GLOBALS['conn']);
    }

    function DelRota() {
        //Apagar rota com ID (rotas,timerotas)
        $id = $_POST['IDRota'];

        $verifica = "SELECT * FROM rotas WHERE id = $id";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica -> num_rows == 0) {
            print '<script>alert("Rota não encontrada!!!")</script>';
        } else {
            $sql = "DELETE FROM time_rotas WHERE id = $id";

            $sql1 = "DELETE FROM rotas WHERE id = $id";

            $result = mysqli_query($GLOBALS['conn'], $sql);
            $result2 = mysqli_query($GLOBALS['conn'], $sql1);

            if ($result && $result2) {
                print '<script>alert("Rota apagada com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao apagar rota\nTente novamente")</script>';
            }
        }
        mysqli_close($GLOBALS['conn']);
    }

    function EditRota() {
        $id = $_POST['IDRota'];

        $verifica = "SELECT * FROM rotas WHERE id = $id";

        $sql = "SELECT rotas.id, rotas.origem, rotas.destino, time_rotas.Data_hora AS horario, time_rotas.capacidade 
        FROM rotas
        JOIN time_rotas ON rotas.id = time_rotas.id";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica && mysqli_num_rows($resultVerifica) > 0) {
            $result = mysqli_query($GLOBALS['conn'], $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['id'] == $id) {
                        $origem = $row['origem'];
                        $destino = $row['destino'];
                        $data_hora = $row['horario'];
                        $capacidade = $row['capacidade'];

                        //Form para editar rota
                        print '<form id="Update" method="post">
                            <input type="number" readonly name="IDRota" value="' . $id . '">
                            <input type="text" name="Origem" value="'. $origem .'" placeholder="Introduza origem" required>
                            <input type="text" name="Destino" value="'. $destino .'" placeholder="Introduza destino" required>
                            <input type="datetime-local" name="data_hora" value="'. $data_hora .'" placeholder="Introduza data e hora" required>
                            <input type="number" name="Capacidade" value="'. $capacidade .'" min="1" max="70" placeholder="Introduz a capacidade" required>
                            <input type="submit" name="EditRota" value="Guardar Alterações">
                        </form>';
                    }
                }
            }
        } else {
            print '<script>alert("Rota não encontrada!!!")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }

    function UpdateRota() {
        $id = $_POST['IDRota'];
        $origem = $_POST['Origem'];
        $destino = $_POST['Destino'];
        $data_hora = $_POST['data_hora'];
        $capacidade = $_POST['Capacidade'];

        $UpdateRota = "UPDATE rotas SET origem='$origem', destino='$destino' WHERE id=$id";

        $UpdateTimeRota = "UPDATE time_rotas SET Data_hora='$data_hora', capacidade='$capacidade' WHERE id=$id";

        $resultRota = mysqli_query($GLOBALS['conn'], $UpdateRota);
        $resultTimeRota = mysqli_query($GLOBALS['conn'], $UpdateTimeRota);

        if ($resultRota && $resultTimeRota) {
            print '<script>alert("Rota atualizada com sucesso!!!")</script>';
        } else {
            print '<script>alert("Erro ao atualizar rota\nTente novamente")</script>';
        }
        mysqli_close($GLOBALS['conn']);
    }

    function DelUser() {
        //Apagar utilizador
        $email = $_POST['EmailUser'];

        $verifica = "SELECT * FROM cliente WHERE email = '$email'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica && mysqli_num_rows($resultVerifica) > 0) {
            $row = mysqli_fetch_assoc($resultVerifica);

            $nif = $row['NIF'];

            //Apagar transações  (NIF)/ carteira (NIF) e utilizador (EMAIL)

            $delTransacao = "DELETE FROM transacoes WHERE NIF = '$nif'";
            $delCarteira = "DELETE FROM carteira WHERE NIF = '$nif'";
            $delCliente = "DELETE FROM cliente WHERE email = '$email'";

            $resultTransacao = mysqli_query($GLOBALS['conn'], $delTransacao);
            $resultCarteira = mysqli_query($GLOBALS['conn'], $delCarteira);
            $resultCliente = mysqli_query($GLOBALS['conn'], $delCliente);

            if ($resultTransacao && $resultCarteira && $resultCliente) {
                print '<script>alert("Utilizador apagado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao apagar utilizador\nTente novamente")</script>';
            }

        } else {
            print '<script>alert("Utilizador não encontrado!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }

    function DelAlerta() {
        //Apagar alerta
        $nomeAlerta = $_POST['NomeAlerta'];

        $verifica = "SELECT * FROM alerta WHERE nomeALERTA = '$nomeAlerta'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica && mysqli_num_rows($resultVerifica) > 0) {
            $sql = "DELETE FROM alerta WHERE nomeALERTA = '$nomeAlerta'";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            if ($result) {
                print '<script>alert("Alerta apagado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao apagar alerta\nTente novamente")</script>';
            }
        } else {
            print '<script>alert("Alerta não encontrado!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }

    function DelFunc() {
        //Apagar funcionário
        $emailFunc = $_POST['NomeFunc'];

        $verifica = "SELECT * FROM admin_func WHERE email = '$emailFunc' AND cargo = 'FUNCIONARIO'";

        $resultVerifica = mysqli_query($GLOBALS['conn'], $verifica);

        if ($resultVerifica && mysqli_num_rows($resultVerifica) > 0) {
            $row = mysqli_fetch_assoc($resultVerifica);

            $nif = $row['NIF'];

            //Apagar transações (NIF)/ carteira (NIF) e funcionário (EMAIL)
            $delTransacao = "DELETE FROM transacoes WHERE NIF = '$nif'";
            $delCarteira = "DELETE FROM carteira WHERE NIF = '$nif'";
            $delFunc = "DELETE FROM admin_func WHERE email = '$emailFunc' AND cargo = 'FUNCIONARIO'";

            $resultTransacao = mysqli_query($GLOBALS['conn'], $delTransacao);
            $resultCarteira = mysqli_query($GLOBALS['conn'], $delCarteira);
            $resulFunc = mysqli_query($GLOBALS['conn'], $delFunc);

            if ($resultTransacao && $resultCarteira && $resulFunc) {
                print '<script>alert("Funcionário apagado com sucesso!!!")</script>';
            } else {
                print '<script>alert("Erro ao apagar funcionário\nTente novamente")</script>';
            }
        } else {
            print '<script>alert("Funcionário não encontrado!!!")</script>';
        }

        mysqli_close($GLOBALS['conn']);
    }
?>