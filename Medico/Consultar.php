<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

if ($_SESSION["tipo"] != "medico") {
    header("Location: /TCC/Geral/Conta.html");
    exit();
}

require_once("../Geral/PHP/conexao.php");

/* ==========================
   DADOS DO MÉDICO
========================== */

$sqlMedico = $conn->prepare("
SELECT
    nome,
    email,
    crm
FROM medico
WHERE id_medico = ? ");

$sqlMedico->bind_param("i", $_SESSION["id"]);
$sqlMedico->execute();

$medico = $sqlMedico->get_result()->fetch_assoc();

/* ==========================
   QUANTIDADE DE LAUDOS
========================== */

$sqlQtd = $conn->prepare("
SELECT COUNT(*) AS total
FROM laudo
WHERE id_medico = ?
");

$sqlQtd->bind_param("i", $_SESSION["id"]);
$sqlQtd->execute();

$qtdLaudos = $sqlQtd->get_result()->fetch_assoc();

/* ==========================
   HISTÓRICO
========================== */

$sqlHistorico = $conn->prepare("
SELECT
    imagem.id_imagem,
    imagem.nome_arquivo,
    imagem.data_envio,
    laudo.data_laudo,
    paciente.nome
FROM laudo

INNER JOIN imagem
ON laudo.id_imagem = imagem.id_imagem

INNER JOIN paciente
ON imagem.id_paciente = paciente.id_paciente

WHERE laudo.id_medico = ?

ORDER BY laudo.data_laudo DESC
");

$sqlHistorico->bind_param("i", $_SESSION["id"]);
$sqlHistorico->execute();

$historico = $sqlHistorico->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKIA - Identificação Inteligente</title>
    <link rel="stylesheet" href="../Style/styleMed.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div><img src="../Imagens/Logo_sem_Fundo.png" alt="Logo da empresa SKIA"></div>

        <nav>
            <a href="indexMed.php">Inicio</a>
            <a href="Skia_med.php">SKIA-IA</a>
            <a href="Pesquisa_med.php">Pesquisar</a>
            <a href="Consultar.php" class="active">Histórico</a>
            <a href="Criadoras.html">Criadoras</a> 
            <a href="perfil.php">Perfil</a>        
     </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
    </header>


    <main class="dashboard-page">

        <div class="dashboard-container">

            <section class="perfil-card">

                <div class="perfil-icon">
                    👤
                </div>
<h1>
    <?php echo htmlspecialchars($medico["nome"]); ?>
</h1>
                <div class="mini-line"></div>


                <button
    class="editar-btn"
    onclick="window.location.href='perfil.php'">

    Editar Perfil

</button>

            </section>

            <!-- CARD DIREITO -->
            <section class="dados-card">

                <h2>

Resumo do Médico

</h2>

                <div class="linha-pequena"></div>

                <div class="dados-medico">

    <p>

        <strong>Nome:</strong><br>

        <?php echo htmlspecialchars($medico["nome"]); ?>

    </p>

    <br>
<strong>CRM:</strong><br>

<?php echo htmlspecialchars($medico["crm"]); ?>

</p>
<br>
    <p>

        <strong>E-mail:</strong><br>

        <?php echo htmlspecialchars($medico["email"]); ?>

    </p>

    <br>
    <p>



    <p>

        <strong>Laudos realizados:</strong><br>

        <?php echo $qtdLaudos["total"]; ?>

    </p>

</div>

                <div class="divider"></div>

                <h3>
                    Laudos realizados
                </h3>

                <div class="historico">

                    <!-- ITEM -->
                    <?php while($linha = $historico->fetch_assoc()) { ?>

<div class="historico-item">

    <div class="historico-icon">

        

    </div>

   <div class="historico-text">

    <strong> Paciente:</strong>
    <?php echo htmlspecialchars($linha["nome"]); ?>

    <br>

    <strong> Arquivo:</strong>
    <?php echo htmlspecialchars($linha["nome_arquivo"]); ?>

    <br>

    <strong> Data da análise:</strong>
    <?php echo date("d/m/Y H:i", strtotime($linha["data_laudo"])); ?>

    <br><br>

    <button
        class="editar-btn"
        onclick="window.location.href='verImagem.php?id=<?php echo $linha["id_imagem"]; ?>'">

        Visualizar

    </button>

</div>

</div>

<?php } ?>


                </div>

            </section>

        </div>

    </main>
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