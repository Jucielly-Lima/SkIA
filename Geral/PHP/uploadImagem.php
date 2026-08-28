<?php

session_start();
require_once "conexao.php";

/* ==========================
   VERIFICA LOGIN
========================== */

if (!isset($_SESSION["id"])) {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

if ($_SESSION["tipo"] != "paciente") {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

/* ==========================
   VERIFICA ENVIO DO FORMULÁRIO
========================== */

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acesso inválido.");
}

if (!isset($_FILES["imagem"])) {
    die("Nenhuma imagem enviada.");
}

$imagem = $_FILES["imagem"];

/* ==========================
   VERIFICA ERRO
========================== */

if ($imagem["error"] != UPLOAD_ERR_OK) {
    die("Erro ao enviar a imagem.");
}

/* ==========================
   EXTENSÃO
========================== */

$extensao = strtolower(pathinfo($imagem["name"], PATHINFO_EXTENSION));

$permitidas = ["jpg", "jpeg", "png"];

if (!in_array($extensao, $permitidas)) {
    die("Formato de arquivo inválido.");
}

/* ==========================
   CRIA A PASTA
========================== */

$pasta = "../../Uploads/";

if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

/* ==========================
   GERA NOME ÚNICO
========================== */

$novoNome = uniqid("img_", true) . "." . $extensao;

/* Caminho físico para salvar o arquivo */

$caminhoFisico = $pasta . $novoNome;

/* ==========================
   MOVE O ARQUIVO
========================== */

if (!move_uploaded_file($imagem["tmp_name"], $caminhoFisico)) {
    die("Não foi possível salvar a imagem.");
}

/* ==========================
   SALVA NO BANCO
========================== */

$sql = $conn->prepare("
    INSERT INTO imagem
    (id_paciente, nome_arquivo, caminho)
    VALUES (?, ?, ?)
");

$sql->bind_param(
    "iss",
    $_SESSION["id"],
    $imagem["name"],
    $novoNome
);

if ($sql->execute()) {

    echo "
    <script>
        alert('Imagem enviada com sucesso!');
        window.location='/TCC/Paciente/Historico.php';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Erro ao salvar no banco de dados.');
        history.back();
    </script>
    ";

}

$sql->close();
$conn->close();

exit();

?>