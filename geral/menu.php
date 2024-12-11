<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- menu.php -->

<!-- Top -->
<div class="w3-top"> 
    <div class="w3-row w3-white w3-padding">
        <div class="w3-half" style="margin:0 0 0 0">
            <a href="."><img src='imagens/logo.png' alt=' Economize já '></a>
        </div>
        <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small">
            <div class="w3-right"> 
                <!-- Carrinho no canto superior direito (visível apenas em telas maiores) -->
                <a href="Carrinho.php" class="w3-bar-item w3-button w3-hover-light-gray w3-large w3-theme w3-padding-16">
                    <img src="imagens/carrinho-de-compras.png" alt="Carrinho" width="40" height="40">
                    <span class="w3-small">Carrinho</span>
                </a>
            </div>
        </div>
    </div>
    <div class="w3-bar w3-theme w3-large" style="z-index:-1">
        <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-light-gray w3-large w3-theme w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-light-gray w3-padding-16" href="OrganizarPedidos.php" onclick="w3_show_nav('menuMedico')"></a>
    </div>
</div>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left" style="z-index:3;width:270px" id="mySidebar" >
    <div class="w3-bar w3-hide-large w3-large">
        <a href="javascript:void(0)" onclick="w3_show_nav('menuMedico')"
           class="w3-bar-item w3-button w3-theme w3-hover-light-gray w3-padding-16" style="width:50%">Pedidos</a>
    </div>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large"
       title="Close Menu">x</a>
    <div id="menuMedico" class="myMenu">
        <div class="w3-container">
            <h3>Organizar pedidos</h3>
        </div>
        <a class="w3-bar-item w3-button" href="OrganizarPedidos.php">Relação de produtos</a>
        <a class="w3-bar-item w3-button" href="IncluirProduto.php">Adicionar um produto</a>

        <!-- Carrinho no Menu Hambúrguer (visível apenas em telas pequenas) -->
        <a href="Carrinho.php" class="w3-bar-item w3-button w3-hover-light-gray w3-padding-16">
            <img src="imagens/carrinho-de-compras.png" alt="Carrinho" width="30" height="30">
            <span class="w3-small">Carrinho</span>
        </a>
    </div>
</div>

<script type="text/javascript" src="js/myScriptClinic.js"></script>

<style>
    /* CSS para controlar visibilidade em diferentes tamanhos de tela */

    /* Exibe o carrinho no topo apenas em telas grandes */
    @media screen and (max-width: 768px) {
        .w3-half.w3-margin-top.w3-wide {
            display: none; /* Esconde o carrinho no topo em telas pequenas */
        }
    }

    /* Exibe o carrinho no menu hambúrguer em telas pequenas */
    @media screen and (max-width: 768px) {
        .w3-sidebar .w3-bar-item.w3-button {
            display: block;
        }
    }
</style>
