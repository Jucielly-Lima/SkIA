<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

if ($_SESSION["tipo"] != "paciente") {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

require_once("../Geral/PHP/conexao.php");

if (!isset($_GET["id"])) {
    die("Resultado não encontrado.");
}

$idImagem = $_GET["id"];

$sql = $conn->prepare("
SELECT
    imagem.*,
    laudo.descricao,
    laudo.data_laudo,
    medico.nome AS medico
FROM imagem
INNER JOIN laudo
    ON imagem.id_imagem = laudo.id_imagem
INNER JOIN medico
    ON laudo.id_medico = medico.id_medico
WHERE imagem.id_imagem = ?
AND imagem.id_paciente = ?
");

$sql->bind_param("ii", $idImagem, $_SESSION["id"]);

$sql->execute();

$resultado = $sql->get_result();

$dados = $resultado->fetch_assoc();

if (!$dados) {
    die("Resultado não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKIA - Identificação Inteligente</title>
    <link rel="stylesheet" href="../Style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div><img src="../Imagens/Logo_sem_Fundo.png" alt="Logo da empresa SKIA"></div>

        <nav>
            <a href="index.html" >Inicio</a>
            <a href="SKIA.html">SKIA-IA</a>
            <a href="Melanoma.html">Melanoma</a>
            <a href="Prevencao.html">Prevenção</a>
            <a href="tratamento.html">Tratamento</a>
            <a href="Criadoras.html">Criadoras</a>
            <a href="Paulinia.html">Paulínia</a>
            <a href="enviarImg.php">Enviar</a>
            <a href="Historico.php" >Histórico</a>
            <a href="perfil.php">Perfil</a>        
       
                </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
        
    </header>
<main class="resultado-page">

    <section class="resultado-container">

        <!-- PERFIL -->
        <aside class="resultado-perfil-card">

            <div class="resultado-perfil-icon">
                👤
            </div>

<h1><?php echo htmlspecialchars($_SESSION["nome"]); ?></h1>
            <div class="resultado-linha"></div>

            <p>
                Aqui você pode visualizar o resultado das análises realizadas.
            </p>

            <button class="resultado-editar-btn">
                Editar Perfil
            </button>

        </aside>

        <!-- CONTEÚDO -->
        <section class="resultado-card">

            <div class="resultado-titulo">

                <h2>Resultado da Análise</h2>

                <p>
                    Visualize abaixo o parecer emitido pelo dermatologista.
                </p>

            </div>

            <!-- STATUS -->

            <div class="resultado-status">

                <span class="status-finalizado">
<?php echo htmlspecialchars($dados["status"]); ?></span>

            </div>

            <!-- IMAGEM -->

            <div class="resultado-imagem">

<img
    src="/TCC/Uploads/<?php echo $dados["caminho"]; ?>"
    alt="Imagem enviada">
            </div>

            <!-- INFORMAÇÕES -->

            <div class="resultado-info">

                <div class="resultado-item">

                    <h3>Arquivo</h3>

<p><?php echo htmlspecialchars($dados["nome_arquivo"]); ?></p>
                </div>

                <div class="resultado-item">

                    <h3>Data do envio</h3>

<p><?php echo date("d/m/Y H:i", strtotime($dados["data_envio"])); ?></p>
                </div>

                <div class="resultado-item">

                    <h3>Data da análise</h3>

<p><?php echo date("d/m/Y H:i", strtotime($dados["data_laudo"])); ?></p>
                </div>

            </div>

            <!-- PARECER -->

            <div class="resultado-box">

                <h3>Diagnóstico Médico</h3>

               <p>
    <?php echo nl2br(htmlspecialchars($dados["descricao"])); ?>
</p>

            </div>
            <div class="resultado-box">

    <h3>Médico Responsável</h3>

    <p>
        Dr(a). <?php echo htmlspecialchars($dados["medico"]); ?>
    </p>

</div>


            

            <!-- BOTÕES -->

            <div class="resultado-botoes">

                <button class="resultado-btn">
                    <a
    href="/TCC/Geral/PHP/gerarPDF.php?id=<?php echo $dados["id_imagem"]; ?>"
    class="resultado-btn">

    Baixar Resultado

</a>
                </button>

                <button
    class="resultado-btn-secundario"
    onclick="window.location.href='Index.php'">

    Voltar ao Inicio

</button>

            </div>

        </section>

    </section>

</main>


   <!-- FOOTER -->
    <footer class="footer">

        <div class="footer-container">

            <!-- COLUNA 1 -->
            <div class="footer-col">

                <div class="footer-logo">
                    🛡 <span>SKIA</span>
                </div>

                <p>
                    Inteligência Artificial aplicada à identificação educacional 
                    e triagem de melanoma.
                    Unindo tecnologia e saúde para um futuro mais preventivo.
                </p>

            </div>

            <!-- COLUNA 2 -->
            <div class="footer-col">

                <h4>Conteúdo</h4>

                <a href="SKIA.html">Sobre a IA</a>
                <a href="Melanoma.html">O que é melanoma?</a>
                <a href="Prevencao.html">Prevenção</a>

            </div>

            <!-- COLUNA 3 -->
            <div class="footer-col">

                <h4>Informação</h4>

                <a href="tratamento.html">Tratamentos</a>
                <a href="Criadoras.html">A Equipe</a>
                <a href="perfil.php">Área do Usuário</a>

            </div>

        </div>

        <div class="footer-divider"></div>

        <div class="footer-bottom">

            <p>
                © 2026 SKIA Project. Todos os direitos reservados.
            </p>

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

<script
    async
    data-id="9934493585"
    id="chtl-script"
    type="text/javascript"
    src="https://chatling.ai/js/embed.js">
</script>
</body>
</html>