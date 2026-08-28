<?php

session_start();

require_once("conexao.php");

/* ===========================
   VERIFICA LOGIN
=========================== */

if(!isset($_SESSION["id"])){

    header("Location: /TCC/Geral/Conta.html");
    exit();

}

if($_SESSION["tipo"] != "medico"){

    header("Location: /TCC/Geral/Conta.html");
    exit();

}

/* ===========================
   DADOS
=========================== */

$idImagem = $_POST["id_imagem"];

$descricao = $_POST["descricao"];

$idMedico = $_SESSION["id"];

/* ===========================
   SALVA LAUDO
=========================== */

$sql = $conn->prepare("

INSERT INTO laudo
(id_imagem,id_medico,descricao)

VALUES

(?,?,?)

");

$sql->bind_param(

"iis",

$idImagem,

$idMedico,

$descricao

);

$sql->execute();

/* ===========================
   ATUALIZA STATUS
=========================== */

$sql2 = $conn->prepare("

UPDATE imagem

SET status='Finalizado'

WHERE id_imagem=?

");

$sql2->bind_param(

"i",

$idImagem

);

$sql2->execute();

?>

<script>

alert("Laudo salvo com sucesso!");

window.location="/TCC/Medico/Pesquisa_med.php";

</script>