<!DOCTYPE html>
<html>
<head>
    <title>EconomizeJa</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuMedico')">

<!-- Inclui MENU.PHP -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
        <div class="w3-code cssHigh notranslate">
            <!-- Acesso em: -->
            <?php
            date_default_timezone_set("America/Sao_Paulo");
            $data = date("d/m/Y H:i:s", time());
            echo "<p class='w3-small'>Acesso em: $data</p>";
            ?>

            <!-- Acesso ao BD-->
            <?php
            // Cria conexão
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Verifica conexão
            if (!$conn) {
                die("<strong>Falha de conexão: </strong>" . mysqli_connect_error());
            }

            // Configura para trabalhar com caracteres acentuados do português
            mysqli_query($conn, "SET NAMES 'utf8'");
            mysqli_query($conn, 'SET character_set_connection=utf8');
            mysqli_query($conn, 'SET character_set_client=utf8');
            mysqli_query($conn, 'SET character_set_results=utf8');

            $id = $_GET['id'];

            // Faz Select na Base de Dados
            $sql = "SELECT ID_Produtos_Pedidos, fk_Produtos_ID_Produtos, Nome FROM Produtos_Pedidos AS PP
                    INNER JOIN Produtos AS P ON PP.fk_Produtos_ID_Produtos = P.ID_Produtos
                    WHERE ID_Produtos_Pedidos = $id";

            // Início DIV form
            echo "<div class='w3-responsive w3-card-4'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="w3-container w3-theme">
                        <h2>Exclusão do Produto Cód. = [<?php echo $row['ID_Produtos_Pedidos']; ?>]</h2>
                    </div>
                    <form class="w3-container" action="produtoExcluir_exe.php" method="post" onsubmit="return check(this.form)">
                        <input type="hidden" id="Id" name="Id" value="<?php echo $row['ID_Produtos_Pedidos']; ?>">
                        <input type="hidden" name="ProdutoId" value="<?php echo $row['fk_Produtos_ID_Produtos']; ?>">

                        <p><label class="w3-text-IE"><b>Nome do Produto: </b><?php echo $row['Nome']; ?></label></p>
                        <p>
                            <input type="submit" value="Confirma exclusão?" class="w3-btn w3-red">
                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='OrganizarPedidos.php'">
                        </p>
                    </form>
                    <?php
                } else {
                    ?>
                    <div class="w3-container w3-theme">
                        <h2>Tentativa de exclusão de Produto inexistente</h2>
                    </div>
                    <br>
                    <?php
                }
            } else {
                echo "<p style='text-align:center'>Erro executando SELECT: " . mysqli_error($conn) . "</p>";
            }
            echo "</div>"; // Fim do form
            mysqli_close($conn);  // Encerra conexão com o BD
            ?>

        </p>
    </div>
    
    <?php require 'geral/sobre.php'; ?>
    <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP -->
    <?php require 'geral/rodape.php'; ?>

</body>
</html>
