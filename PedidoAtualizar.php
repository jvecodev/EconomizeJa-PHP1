<!DOCTYPE html>
<html>
<head>
    <title>EconomizeJa</title>
    <link rel="icon" type="image/png" href="imagens/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuMedico')">
    
    <?php 
    require 'geral/menu.php'; 
    require 'bd/conectaBD.php'; 

    // Verifica se o 'id' foi passado via GET e é um número válido
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    if ($id <= 0) {
        die("<p>Pedido não encontrado.</p>");
    }

    // Cria a conexão
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
    }
    mysqli_set_charset($conn, 'utf8');
    ?>

    <div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
            <p class="w3-large">
            <div class="w3-code cssHigh notranslate">
                
                <!-- Acesso em:-->
                <?php
                date_default_timezone_set("America/Sao_Paulo");
                $data = date("d/m/Y H:i:s", time());
                echo "<p class='w3-small'>Acesso em: $data</p>";
                ?>

                <!-- Acesso ao BD-->
                <?php
                // SQL para selecionar o pedido com o id fornecido
                $sql = "SELECT ID_Produtos_Pedidos, fk_Produtos_ID_Produtos, Nome, Descricao, Quantidade, Preco, Nicho 
                        FROM Produtos_Pedidos 
                        INNER JOIN Produtos ON fk_Produtos_ID_Produtos = ID_Produtos
                        WHERE ID_Produtos_Pedidos = ?";
                
                // Prepara a consulta
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Vincula o parâmetro
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);

                        $id_produto = $row["ID_Produtos_Pedidos"];
                        $nome = $row["Nome"];
                        $descricao = $row["Descricao"];
                        $quantidade = $row["Quantidade"];
                        $preco = $row["Preco"];
                        $nicho = $row["Nicho"];
                        
                        // Seleciona todos os produtos para a dropdown
                        $sqlG = "SELECT ID_Produtos, Nome FROM Produtos";
                        $optionsEspec = array();
                        if ($resultG = mysqli_query($conn, $sqlG)) {
                            while ($rowG = mysqli_fetch_assoc($resultG)) {
                                $optionsEspec[] = array("id" => $rowG["ID_Produtos"], "nome" => $rowG["Nome"]);
                            }
                        }
                        ?>
                        <div class="w3-container w3-theme">
                            <h2>Altere os dados do pedido = [<?php echo $nome; ?>]</h2>
                        </div>
                        <form class="w3-container" action="PedidoAtualizar_exe.php" method="post">
                            <table class="w3-table-all">
                                <tr>
                                    <td style="width:50%;">
                                        <input type="hidden" id="Id" name="Id" value="<?php echo $id_produto; ?>">

                                        <p><label class="w3-text-IE"><b>Nicho</b></label>
                                            <input type="text" name="nicho" id="nicho" class="w3-input w3-border w3-light-grey" value="<?php echo $nicho; ?>" required>
                                        </p>

                                        <p><label class="w3-text-IE"><b>Nome do produto</b>*</label>
                                            <input type="text" name="Nome_produto" id="Nome_produto" class="w3-input w3-border w3-light-grey" value="<?php echo $nome; ?>" required>
                                        </p>

                                        <p><label class="w3-text-IE"><b>Quantidade</b></label>
                                            <input class="w3-input w3-border w3-light-grey" name="quantidade" type="number" min="1" max="999" step="1"
                                                   placeholder="Quantidade" title="Quantidade" value="<?php echo $quantidade; ?>" required>
                                        </p>

                                        <p><label class="w3-text-IE"><b>Descrição</b></label>
                                            <textarea class="w3-input w3-border w3-light-grey" name="descricao" rows="4" placeholder="Descrição do produto"><?php echo $descricao; ?></textarea>
                                        </p>

                                        <p><label class="w3-text-IE"><b>Preço (R$)</b></label>
                                            <input class="w3-input w3-border w3-light-grey" name="preco" type="text" value="<?php echo $preco; ?>" required>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center">
                                        <p>
                                            <input type="submit" value="Alterar" class="w3-btn w3-red">
                                            <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='OrganizarPedidos.php'">
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        </form>
                        <?php
                    } else {
                        echo "<div class='w3-container w3-theme'><h2>Pedido inexistente</h2></div><br>";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "<p style='text-align:center'>Erro executando SELECT: " . mysqli_error($conn) . "</p>";
                }
                mysqli_close($conn);  // Encerra conexão com o BD
                ?>
            </div>
        </div>
    </div>

    <?php require 'geral/sobre.php'; ?>
    <!-- FIM PRINCIPAL -->
    </div>
    <!-- Inclui RODAPE.PHP -->
    <?php require 'geral/rodape.php'; ?>

</body>
</html>
