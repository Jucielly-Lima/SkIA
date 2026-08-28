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
    nome,
    usuario,
    email
FROM paciente
WHERE id_paciente = ?
");

$sql->bind_param("i", $_SESSION["id"]);

$sql->execute();

$resultado = $sql->get_result();
$paciente = $resultado->fetch_assoc();
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
            <a href="Historico.php" >Histórico</a>
            <a href="perfil.php" class="active">Perfil</a>        
       
                </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
        
    </header>
<main class="perfil-page">

    <section class="perfil-container">

        <!-- LADO ESQUERDO -->

        <aside class="perfil-card">

            <div class="perfil-avatar">
                👤
            </div>

<h1><?php echo htmlspecialchars($paciente["usuario"]);?></h1>
            <div class="perfil-linha"></div>

            <p>
                Gerencie suas informações pessoais.
            </p>

        </aside>

        <!-- LADO DIREITO -->

        <section class="perfil-main">

            <div class="perfil-header">

                <h2>Meu Perfil</h2>

                <p>
                    Dados pessoais e informações da conta.
                </p>

            </div>

            <form class="perfil-form">

                <div class="perfil-grid">

                    <div class="perfil-input">

                        <label>Nome Completo</label>

        <?php echo htmlspecialchars($paciente["nome"]); ?>

                    </div>

                    <div class="perfil-input">

                        <label>Usuário</label>

<?php echo htmlspecialchars($paciente["usuario"]);?>
                    </div>

                    <div class="perfil-input">

                        <label>E-mail</label>

<?php echo htmlspecialchars($paciente["email"]);?>
                    </div>

                </div>

            </form>

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