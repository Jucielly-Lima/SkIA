<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "conexao.php";

// Verifica se veio do formulário
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acesso inválido.");
}

// Recebe os dados
$usuario = trim($_POST["usuario"]);
$nome = trim($_POST["nome"]);
$email = trim($_POST["email"]);
$crm = trim($_POST["crm"]);
$especialidade = trim($_POST["especialidade"]);
$senha = $_POST["senha"];

// Criptografa a senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se já existe usuário, e-mail ou CRM
$verifica = $conn->prepare("
    SELECT usuario, email
FROM medico
WHERE usuario = ? OR email = ?

UNION

SELECT usuario, email
FROM paciente
WHERE usuario = ? OR email = ?");


if (!$verifica) {
    die("Erro no SELECT: " . $conn->error);
}

$verifica->bind_param(
    "ssss",
    $usuario,
    $email,
    $usuario,
    $email
);


$verifica->execute();

$resultado = $verifica->get_result();

if ($resultado->num_rows > 0) {

    echo "
    <script>
        alert('Usuário, e-mail ou CRM já cadastrado!');
        history.back();
    </script>
    ";

} else {

    $sql = $conn->prepare("
        INSERT INTO medico
        (usuario, nome, email, crm, especialidade, senha)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    if (!$sql) {
        die("Erro no INSERT: " . $conn->error);
    }

    $sql->bind_param(
        "ssssss",
        $usuario,
        $nome,
        $email,
        $crm,
        $especialidade,
        $senhaHash
    );

    if ($sql->execute()) {

        echo "
        <script>
            alert('Cadastro realizado com sucesso!');
            window.location='/TCC/Geral/Conta.html';
        </script>
        ";

    } else {

        die("Erro ao executar INSERT: " . $sql->error);

    }

    $sql->close();
}

$verifica->close();
$conn->close();

?>