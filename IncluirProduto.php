<!DOCTYPE html>
<html>
<head>
    <title>Incluir Produto</title>
    <link rel="icon" type="image/png" href="imagens/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body onload="w3_show_nav('menuProdutos')">

<!-- Inclui MENU.PHP -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <div class="w3-code cssHigh notranslate">
            <!-- Acesso em:-->
            <?php
            date_default_timezone_set("America/Sao_Paulo");
            $data = date("d/m/Y H:i:s", time());
            echo "<p class='w3-small'>Acesso em: $data</p>";
            ?>

            <div class="w3-responsive w3-card-4">
                <div class="w3-container w3-theme">
                    <h2>Informe o novo produto</h2>
                </div>

                <!-- Formulário para inclusão de produto e pedido -->
                <form class="w3-container" action="prodIncluir_exe.php" method="post" enctype="multipart/form-data">
                    <table class='w3-table-all'>
                        <tr>
                            <td style="width:50%;">
                                <!-- Inputs para a tabela Produtos -->
                                <p>
                                    <label class="w3-text-IE"><b>Nicho</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Nicho" type="text" maxlength="20" required>
                                </p>
                                <p>
                                    <label class="w3-text-IE"><b>Nome do Produto</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" maxlength="50" required>
                                </p>
                                <p>
                                    <label class="w3-text-IE"><b>Descrição</b></label>
                                    <textarea class="w3-input w3-border w3-light-grey" name="Descricao" maxlength="150"></textarea>
                                </p>
                                <p>
                                    <label class="w3-text-IE"><b>Preço</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Preco" type="number" step="0.01" required>
                                </p>
                            </td>

                            <td style="width:50%;">
                                <!-- Inputs para a tabela Produtos_Pedidos -->
                                <p>
                                    <label class="w3-text-IE"><b>Quantidade</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Quantidade" type="number" required>
                                </p>
                                <p>
                                    <label class="w3-text-IE"><b>Data de Fabricação</b>*</label>
                                    <input class="w3-input w3-border w3-light-grey" name="Dt_Fabricacao" type="date" required>
                                </p>
                                <p>
                                    <label class="w3-text-IE"><b>Data de Validade</b></label>
                                    <input class="w3-input w3-border w3-light-grey" name="Dt_Validade" type="date">
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <p>
                                    <input type="submit" value="Salvar" class="w3-btn w3-theme">
                                    <input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='OrganizarPedidos.php'">
                                </p>
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
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
