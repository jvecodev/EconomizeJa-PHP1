<!DOCTYPE html>
<!-- OrganizarPedidos.php -->

<html>
<head>
    <title>Produtos</title>
    <link rel="icon" type="image/png" href="imagens/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuMedico')">

<!-- Inclui MENU.PHP -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal -->
<div class="w3-main w3-container" style="margin-left:270px; margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <p class="w3-large">
        </p>
        
        <!-- Exibe a data e hora do acesso -->
        <div class="w3-code cssHigh notranslate">
            <?php
                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small'>Acesso em: $data</p>";
            ?>
        </div>

        <!-- Título da seção -->
        <div class="w3-container w3-theme">
            <h2>Listagem dos produtos</h2>
        </div>

        <!-- Acesso ao Banco de Dados e exibição dos produtos -->
        <?php

        // Cria a conexão com o banco de dados
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Verifica a conexão
        if (!$conn) {
            echo "</table>";
            echo "</div>";
            die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
        }

        // Configura para trabalhar com caracteres acentuados do português
        mysqli_query($conn, "SET NAMES 'utf8'");
        mysqli_query($conn, 'SET character_set_connection=utf8');
        mysqli_query($conn, 'SET character_set_client=utf8');
        mysqli_query($conn, 'SET character_set_results=utf8');

        // Query para buscar os dados
        $sql = "
            SELECT 
                ID_Produtos_Pedidos, 
                Nome, 
                Descricao, 
                Quantidade, 
                Nicho, 
                CONCAT('R$', Preco) AS Preco, 
                CONCAT('R$', Preco * Quantidade) AS Total 
            FROM Produtos_Pedidos 
            INNER JOIN Produtos ON fk_Produtos_ID_Produtos = ID_Produtos 
            ORDER BY ID_Produtos_Pedidos
        ";

        echo "<div class='w3-responsive w3-card-4'>";

        // Executa a query e verifica se há resultados
        if ($result = mysqli_query($conn, $sql)) {
            echo "<table class='w3-table-all'>";
            echo "<tr>
                    <th width='7%'>ID Produto</th>
                    <th width='14%'>Nome</th>
                    <th width='14%'>Descrição</th>
                    <th width='7%'>Quantidade</th>
                    <th width='7%'>Nicho</th>
                    <th width='7%'>Preço</th>
                    <th width='7%'>Valor total</th>
                    <th width='7%'> </th>
                    <th width='7%'> </th>
                  </tr>";

            // Exibe os dados de cada produto
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $cod = $row["ID_Produtos_Pedidos"];
                    $id_produto = $row["ID_Produtos_Pedidos"];
                    $nome = $row["Nome"];
                    $descricao = $row["Descricao"];
                    $quantidade = $row["Quantidade"];
                    $nicho = $row["Nicho"];
                    $preco = $row["Preco"];
                    $total = $row["Total"];

                    echo "<tr>
                            <td>{$id_produto}</td>
                            <td>{$nome}</td>
                            <td>{$descricao}</td>
                            <td>{$quantidade}</td>
                            <td>{$nicho}</td>
                            <td>{$preco}</td>
                            <td>{$total}</td>
                            <td><a href='ProdutoAdicionar_exe.php?id={$cod}'><img src='imagens/mais.png' title='Adicionar Pedido' width='24'></a></td>
                            <td><a href='PedidoAtualizar.php?id={$cod}'><img src='imagens/lapis.png' title='Editar Pedido' width='24'></a></td>
                            <td><a href='ProdutoExcluir.php?id={$cod}'><img src='imagens/lixeira.png' title='Excluir Pedido' width='24'></a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhum produto encontrado.</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "Erro executando SELECT: " . mysqli_error($conn);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conn);
        ?>
    </div>

    <!-- Inclui a seção 'Sobre' -->
    <?php require 'geral/sobre.php'; ?>

</div>

<!-- Inclui o Rodapé -->
<?php require 'geral/rodape.php'; ?>

</body>
</html>
