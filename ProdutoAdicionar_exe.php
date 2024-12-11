<?php
require 'bd/conectaBD.php';

// Captura o ID do produto que foi clicado
$id_produto = $_GET['id'];  // O ID do produto será passado na URL

// Captura a data atual
$data = date('Y-m-d');

// Conexão com o banco de dados
$conn = mysqli_connect($servername, $username, $password, $database);

// Verifica a conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Configura para caracteres especiais
mysqli_set_charset($conn, "utf8");

// Verifica se o produto já foi adicionado no pedido
$sql_verifica = "SELECT * FROM Pedido WHERE fk_Produto_ID_Produto = '$id_produto'";
$resultado = mysqli_query($conn, $sql_verifica);

if (mysqli_num_rows($resultado) > 0) {
    // Produto já existe no pedido, pode-se retornar ou atualizar
    echo "<script>alert('Este produto já foi adicionado ao pedido!'); window.location.href='OrganizarPedidos.php';</script>";
} else {
    // Insere o produto no pedido
    $sql = "INSERT INTO Pedido (fk_Produto_ID_Produto, Data) VALUES ('$id_produto', '$data')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Produto adicionado ao pedido com sucesso!'); window.location.href='OrganizarPedidos.php';</script>";
    } else {
        echo "Erro ao adicionar produto ao pedido: " . mysqli_error($conn);
    }
}

// Fecha a conexão
mysqli_close($conn);
?>
