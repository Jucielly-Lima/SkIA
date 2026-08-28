<?php

session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acesso inválido.");
}

$usuario = trim($_POST["usuario"]);
$senha = $_POST["senha"];

// TAB PACIENTE

$sql = $conn->prepare("
    SELECT *
    FROM paciente
    WHERE usuario = ?
");

$sql->bind_param("s", $usuario);
$sql->execute();

$resultado = $sql->get_result();

if ($resultado->num_rows > 0) {

    $paciente = $resultado->fetch_assoc();

    if (password_verify($senha, $paciente["senha"])) {

        // CRIA A SESSÃO DO PACIENTE
        $_SESSION["id"] = $paciente["id_paciente"];
        $_SESSION["nome"] = $paciente["nome"];
        $_SESSION["tipo"] = "paciente";

        // REDIRECIONA PARA A ÁREA DO PACIENTE
        header("Location: /TCC/Paciente/index.php");
        exit();

    } else {

        echo "Senha incorreta.";

    }

} else {

    // TAB MÉDICO

    $sql = $conn->prepare("
        SELECT *
        FROM medico
        WHERE usuario = ?
    ");

    $sql->bind_param("s", $usuario);
    $sql->execute();

    $resultado = $sql->get_result();

    if ($resultado->num_rows > 0) {

        $medico = $resultado->fetch_assoc();

        if (password_verify($senha, $medico["senha"])) {

            // CRIA A SESSÃO DO MÉDICO
            $_SESSION["id"] = $medico["id_medico"];
            $_SESSION["nome"] = $medico["nome"];
            $_SESSION["tipo"] = "medico";

            // REDIRECIONA PARA A ÁREA DO MÉDICO
            header("Location: /TCC/Medico/indexMed.php");
            exit();

        } else {

            echo "Senha incorreta.";

        }

    } else {

        echo "Usuário não encontrado.";

    }

}

$sql->close();
$conn->close();

?>