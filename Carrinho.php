<!DOCTYPE html>
<html>
<head>
    <title>Carrinho de Produtos</title>
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
            <h2>Itens no Carrinho</h2>
        </div>

        <!-- Acesso ao Banco de Dados e exibição dos produtos no carrinho -->
        <?php

        // Conexão com o banco de dados
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

        // Query para buscar os itens do carrinho
        $sql = "
            SELECT 
                Pedido.ID_Pedido,
                Produtos.Nome,
                Produtos.Descricao,
                Pedido.Data
            FROM Pedido
            INNER JOIN Produtos ON Pedido.fk_Produto_ID_Produto = Produtos.ID_Produtos
            ORDER BY Pedido.ID_Pedido
        ";

        echo "<div class='w3-responsive w3-card-4'>";

        if ($result = mysqli_query($conn, $sql)) {
            echo "<table class='w3-table-all'>";
            echo "<tr>
                    <th>ID Pedido</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data do Pedido</th>
                    <th>Excluir</th>
                  </tr>";

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Adicionando o ícone de lixeira como link para exclusão
                    echo "<tr>
                            <td>{$row['ID_Pedido']}</td>
                            <td>{$row['Nome']}</td>
                            <td>{$row['Descricao']}</td>
                            <td>{$row['Data']}</td>
                            <td><a href='excluirCarrinho.php?id={$row['ID_Pedido']}'  title='Excluir'>
                                    <img src='imagens/lixeira.png' title='Excluir Pedido' width='24'>
                                  </a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum item no carrinho.</td></tr>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "Erro ao consultar os produtos no pedido: " . mysqli_error($conn);
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
