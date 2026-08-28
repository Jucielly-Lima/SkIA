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

$sql = $conn->prepare("
SELECT
    id_imagem,
    nome_arquivo,
    status,
    data_envio
FROM imagem
WHERE id_paciente = ?
ORDER BY data_envio DESC
");

$sql->bind_param("i", $_SESSION["id"]);

$sql->execute();

$resultado = $sql->get_result();
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
            <a href="index.php" >Inicio</a>
            <a href="SKIA.html">SKIA-IA</a>
            <a href="Melanoma.html">Melanoma</a>
            <a href="Prevencao.html">Prevenção</a>
            <a href="tratamento.html">Tratamento</a>
            <a href="Criadoras.html">Criadoras</a>
            <a href="Paulinia.html">Paulínia</a>
            <a href="enviarImg.php">Enviar</a>
            <a href="Historico.php"  class="active">Histórico</a>
            <a href="perfil.php">Perfil</a>        
       
                </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
        
    </header>
<main class="paciente-historico-page">

    <div class="paciente-historico-container">

        <aside class="paciente-historico-sidebar">

            <div class="paciente-historico-avatar">
                👤
            </div>

            <h1><?php echo $_SESSION["nome"]; ?></h1>

            <div class="paciente-historico-divider"></div>

            <p>
                Aqui você pode acompanhar todas as solicitações
                enviadas para análise médica.
            </p>

            <button
                class="paciente-historico-btn"
                onclick="window.location.href='perfil.php'">

                Editar Perfil

            </button>

        </aside>

        <section class="paciente-historico-main">

    <div class="paciente-historico-header">

        <h2>Histórico de Solicitações</h2>

        <p>
            Consulte o andamento das imagens enviadas
            e visualize os resultados disponíveis.
        </p>

    </div>

    <?php while($linha = $resultado->fetch_assoc()) { ?>

        <div class="paciente-historico-registro">

            <div class="paciente-historico-dados">

                <h3><?php echo htmlspecialchars($linha["nome_arquivo"]); ?></h3>

                <p>
                    Enviado em:
                    <?php echo date("d/m/Y H:i", strtotime($linha["data_envio"])); ?>
                </p>

            </div>

            <?php if($linha["status"] == "Pendente"){ ?>

                <span class="paciente-historico-status paciente-status-pendente">
                    Pendente
                </span>

            <?php } elseif($linha["status"] == "Em análise"){ ?>

                <span class="paciente-historico-status paciente-status-analise">
                    Em análise
                </span>

            <?php } else { ?>

                <div class="paciente-historico-acoes">

                    <span class="paciente-historico-status paciente-status-finalizado">
                        Finalizado
                    </span>

                    <button
                        class="paciente-historico-resultado"
                        onclick="window.location.href='Resultado.php?id=<?php echo $linha["id_imagem"]; ?>'">

                        Ver Resultado

                    </button>

                </div>

            <?php } ?>

        </div>

    <?php } ?>

</section>

    </div>

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