<?php
session_start();
require_once("../Geral/PHP/conexao.php");

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "medico") {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

$resultado = null;

if (isset($_GET["pesquisa"]) && !empty($_GET["pesquisa"])) {

    $pesquisa = $_GET["pesquisa"];

    $sql = $conn->prepare("
        SELECT
            imagem.id_imagem,
            paciente.nome,
            imagem.status,
            imagem.data_envio
        FROM imagem
        INNER JOIN paciente
            ON imagem.id_paciente = paciente.id_paciente
        WHERE paciente.nome LIKE ?
        ORDER BY imagem.data_envio DESC
    ");

    $busca = "%" . $pesquisa . "%";
    $sql->bind_param("s", $busca);
    $sql->execute();
    $resultado = $sql->get_result();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SKIA - Pesquisa</title>

<link rel="stylesheet" href="../Style/styleMed.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="pesquisa-page">

<header>
    <div>
        <img src="../Imagens/Logo_sem_Fundo.png" alt="Logo da empresa SKIA">
    </div>

    <nav>
        <a href="indexMed.php">Inicio</a>
        <a href="Skia_med.php">SKIA-IA</a>
        <a href="Pesquisa_med.php" class="active">Pesquisar</a>
        <a href="Consultar.php">Histórico</a>
        <a href="Criadoras.html">Criadoras</a>
        <a href="perfil.php">Perfil</a>
    </nav>

    <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
</header>

<main class="pesquisa-container">

<section class="pesquisa-card">
    <div class="pesquisa-icon">👤</div>

    <h1>Bem-vinda à Pesquisa</h1>

    <div class="mini-line"></div>

    <p>
        Pesquise pacientes cadastrados, visualize imagens enviadas e realize análises dermatológicas de forma organizada.
    </p>
</section>

<section class="pesquisa-search-card">

<h2>Área de Pesquisa</h2>

<form method="GET">

<div class="pesquisa-search-box">
<input
type="text"
name="pesquisa"
placeholder="Pesquisar paciente..."
value="<?php echo isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : ""; ?>">

<button type="submit">🔍</button>
</div>

</form>

<div class="pesquisa-resultado-box">

<?php
if ($resultado !== null && $resultado->num_rows > 0) {

    while ($linha = $resultado->fetch_assoc()) {
?>

<div class="resultado-card">

    <h3><?php echo $linha["nome"]; ?></h3>

    <p><b>Status:</b> <?php echo $linha["status"]; ?></p>

    <p><b>Data:</b> <?php echo $linha["data_envio"]; ?></p>

    <br>

    <a class="abrir-btn"
       href="verImagem.php?id=<?php echo $linha["id_imagem"]; ?>">
        Abrir Solicitação
    </a>

</div>

<br>

<?php
    }
} else {
?>

<p>Nenhuma pesquisa realizada.</p>

<?php
}
?>

</div>

</section>

</main>

<footer class="footer">

<div class="footer-container">

<div class="footer-col">
<div class="footer-logo">🛡 <span>SKIA</span></div>

<p>
Inteligência Artificial aplicada à identificação educacional
e triagem de melanoma.
Unindo tecnologia e saúde para um futuro mais preventivo.
</p>
</div>

<div class="footer-col">
                <h4>Conteúdo</h4>

                <a href="indexMed.php">Inicio</a>
                <a href="Pesquisa_med.php">Área de pesquisa</a>
                <a href="Consultar.php">Histórico</a>

            </div>

            <!-- COLUNA 3 -->
            <div class="footer-col">

                <h4>Informação</h4>

                <a href="Skia_med.php">Inteligência Artificial</a>
                <a href="Criadoras.html">A Equipe</a>
                <a href="perfil.php">Área do Usuário</a>

            </div>

</div>

<div class="footer-divider"></div>

<div class="footer-bottom">

<p>© 2026 SKIA Project. Todos os direitos reservados.</p>

<p class="disclaimer">
Aviso: O SKIA é um projeto científico e educacional.
Não substitui o diagnóstico médico profissional.
Consulte sempre um dermatologista.
</p>

</div>

</footer>

<script>
window.chtlConfig = {
    chatbotId: "9934493585"
};
</script>

<script async
data-id="9934493585"
id="chtl-script"
type="text/javascript"
src="https://chatling.ai/js/embed.js">
</script>

</body>
</html>