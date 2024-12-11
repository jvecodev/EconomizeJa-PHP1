

<style>
    /* Definindo um estilo para os membros da equipe */
.team-members {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: column;
}

.team-member {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    width : 100%;
}

.team-member p {
    margin-right: 10px;
}

.team-image {
    width: 32px;
    height: 32px;
    
    
}

</style>
<body onload="w3_show_nav('menuMedico')">
<div id="Sobre" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content" style="max-width:500px">
        <header class="w3-container w3-theme">
            <span onclick="document.getElementById('Sobre').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <h2>EconomizeJa</h2>
        </header>
        <div class="w3-container">
            <p><b>Aplicação Web com PHP & BD Relacional</b></p>
            <p class="w3-small">Profa. Cristina Verçosa Pérez Barrios de Souza</p>
            <div class="team-members">
                <div class="team-member">
                    <p>João Vitor Correa Oliveira</p>
                    <img src="imagens/oculos.png" alt="" class="team-image">
                </div>
                <div class="team-member">
                    <p>Eduardo Henrique Fabri</p>
                    <img src="imagens/j.png" alt="" class="team-image">
                </div>
                <div class="team-member">
                    <p>Renan Herculano</p>
                    <img src="imagens/r.png" alt="" class="team-image">
                </div>
            </div>
        </div>
        <footer class="w3-container w3-theme">
            <p>PUCPR 2024</p>
        </footer>
    </div>
</div>

</body>
</html>


