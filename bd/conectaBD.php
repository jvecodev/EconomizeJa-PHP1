<!-------------------------------------------------------------------------------
Oficina Desenvolvimento Web
PUCPR

CONECTABD.PHP - deve ser incluído em todos os arquivos PHP que precisam de acesso à BD

Profa. Cristina V. P. B. Souza
Agosto/2022
---------------------------------------------------------------------------------->
<?php
global $servername ;
global $username;
global $password;
global $database;

$servername = "localhost";
$username = "root";
$password = "";
$database = "BDPROJETO2";

$conn = mysqli_connect($servername, $username, $password, $database);

?>




