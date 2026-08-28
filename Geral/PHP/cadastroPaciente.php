<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "conexao.php";

$usuario = trim($_POST["usuario"]);
$nome = trim($_POST["nome"]);
$email = trim($_POST["email"]);
$senha = $_POST["senha"];

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$verifica = $conn->prepare("
    SELECT usuario, email
    FROM paciente
    WHERE usuario = ? OR email = ?

    UNION

    SELECT usuario, email
    FROM medico
    WHERE usuario = ? OR email = ?
");

$verifica->bind_param(
    "ssss",
    $usuario,
    $email,
    $usuario,
    $email
);

$verifica->execute();

$resultado = $verifica->get_result();

if($resultado->num_rows > 0){

    echo "<script>
            alert('Usuário ou e-mail já cadastrado!');
            history.back();
          </script>";

}else{

    $sql = $conn->prepare("INSERT INTO paciente(usuario,nome,email,senha) VALUES(?,?,?,?)");
    $sql->bind_param("ssss",$usuario,$nome,$email,$senhaHash);

    if($sql->execute()){

        echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location='/TCC/Geral/Conta.html';
        </script>";

    }else{

        echo "<script>
        alert('Erro ao cadastrar.');
        history.back();
        </script>";

    }

    $sql->close();
}

$verifica->close();
$conn->close();

?>