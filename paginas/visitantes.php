<?php
    //Dashboard para visitantes
    require '../basedados/basedados.h';
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felix Bus -- Visitantes</title>
    <link rel="shortcut icon" href="../paginas/Media/FelixBusLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/visitantes.css">
</head>
<body>
    <header>
        <img src="../paginas/Media/FelixBusLogo.png" alt="Felix Bus Logo">
        <h1>Felix Bus - Bem-vindo Visitante!</h1>
    </header>
    <main>
        <?php
            $sql = "SELECT * FROM alerta WHERE estado = 'Visivel'";

            $result = mysqli_query($GLOBALS['conn'], $sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='alert'>⚠️ ". $row['nomeALERTA'] ." --> ". $row['descricao'] ."</div>";
                }
            }
        ?>

        <div class="search">
            <h2>Pesquisar Viagens</h2>
            <form method="POST">
                    <label for="Origem">Origem:</label>
                    <select name="Origem">
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
                    <label for="Destino">Destino:</label>
                    <select name="Destino">
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
                <button type="submit" name="Pesquisa" >Pesquisar</button>
            </form>
        </div>

        <div class="register">
            <p>Ainda não tem conta? <a href="../paginas/signup.html">Registe-se aqui</a>.</p>
        </div>
    </main>
</body>
</html>

<?php
    if(isset($_POST['Pesquisa'])){
        $Origem = $_POST['Origem'];
        $Destino = $_POST['Destino'];

        $sql = "SELECT rotas.id, rotas.origem, rotas.destino, time_rotas.Data_hora AS horario, time_rotas.capacidade 
                    FROM rotas
                    JOIN time_rotas ON rotas.id = time_rotas.id WHERE rotas.origem = '$Origem' AND rotas.destino = '$Destino'";
        $result = mysqli_query($GLOBALS['conn'], $sql);
        $queryResult = mysqli_num_rows($result);

        if($queryResult > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='viagem'>
                        <h3>Viagem de ".$row['origem']." para ".$row['destino']."</h3>
                        <p>Horário: ".$row['horario']."</p>";
                        if (isset($row['capacidade']) <= 0) {
                            echo "<p>Capacidade:<strong style='color: red'>Esgotado</strong></p>";
                        } else {
                            echo "<p>Capacidade: ". $row['capacidade'] ."</p>";
                        }
                        print "<p>Preço: 7-20 €</p>
                    </div>";
            }
        } else {
            echo "<div class='alert'>⚠️ Não foram encontradas viagens com os critérios de pesquisa selecionados. ⚠️ </div>";
        }

        mysqli_close($GLOBALS['conn']);
    }
?>