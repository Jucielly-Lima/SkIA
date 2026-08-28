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

if (!isset($_GET["id"])) {
    die("Imagem não encontrada.");
}

$id = $_GET["id"];

$sql = $conn->prepare("

SELECT

    imagem.*,

    paciente.nome,

    laudo.descricao,

    laudo.data_laudo

FROM imagem

INNER JOIN paciente
ON imagem.id_paciente = paciente.id_paciente

LEFT JOIN laudo
ON imagem.id_imagem = laudo.id_imagem

WHERE imagem.id_imagem = ?

");

$sql->bind_param("i", $id);

$sql->execute();

$resultado = $sql->get_result();

$dados = $resultado->fetch_assoc();

if (!$dados) {
    die("Imagem não encontrada.");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKIA - Identificação Inteligente</title>
    <link rel="stylesheet" href="../Style/styleMed2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div><img src="../Imagens/Logo_sem_Fundo.png" alt="Logo da empresa SKIA"></div>

        <nav>
            <a href="indexMed.php"  class="active">Inicio</a>
            <a href="Skia_med.php">SKIA-IA</a>
            <a href="Pesquisa_med.php">Pesquisar</a>
            <a href="Consultar.php">Histórico</a>
            <a href="Criadoras.html">Criadoras</a>
                    <a href="perfil.php">Perfil</a>        
      </nav>

        </button>
        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
    </header>
<main class="ver-container">

    <!-- CARD ESQUERDO -->

    <aside class="ver-perfil-card">

        <div class="ver-perfil-icon">
            🩺
        </div>

        <h2>Solicitação Médica</h2>

        <div class="ver-linha"></div>

        <p>
            Analise cuidadosamente a imagem enviada pelo paciente,
            registre suas observações e finalize o laudo quando concluir.
        </p>

    </aside>

    <!-- CARD DIREITO -->

    <section class="ver-card">

        <div class="ver-titulo">

            <h2>Análise da Lesão</h2>

            <p>
                Informações da solicitação enviada pelo paciente.
            </p>

        </div>

        <br>

        <!-- DADOS -->

        <div class="ver-dados">

            <div>
                <strong>Paciente:</strong><br>
                <?php echo $dados["nome"]; ?>
            </div>

            <div>
                <strong>Data do envio:</strong><br>
                <?php echo $dados["data_envio"]; ?>
            </div>

            <div>
                <strong>Status:</strong><br>
                <?php echo $dados["status"]; ?>
            </div>

        </div>

        <br><br>

        <!-- IMAGEM -->

        <div class="ver-imagem">

        
<img src="/TCC/Uploads/<?php echo $dados["caminho"]; ?>" alt="Imagem">
        </div>

        <br><br>

        <!-- LAUDO -->

        <form
            action="../Geral/PHP/salvarLaudo.php"
            method="POST"
            class="ver-form">

            <input
                type="hidden"
                name="id_imagem"
                value="<?php echo $dados["id_imagem"]; ?>">

            <label><strong>Laudo Médico</strong></label>

<textarea
    name="descricao"
    rows="10"
    placeholder="Descreva suas observações..."
    <?php if($dados["status"] == "Finalizado"){ echo "readonly"; } ?>
    required><?php echo htmlspecialchars($dados["descricao"] ?? ""); ?></textarea>

            <br><br>

<?php if($dados["status"] != "Finalizado"){ ?>

<button
    type="submit"
    class="ver-btn">

    Finalizar Laudo

</button>

<?php } ?>

        </form>

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