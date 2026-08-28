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

$sqlMedico = $conn->prepare("
SELECT
    nome,
    usuario,
    email,
    crm
FROM medico
WHERE id_medico = ?
");

$sqlMedico->bind_param("i", $_SESSION["id"]);

$sqlMedico->execute();

$resultado = $sqlMedico->get_result();
$sqlMedico = $resultado->fetch_assoc();
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
            <a href="indexMed.php" >Inicio</a>
            <a href="Skia_med.php">SKIA-IA</a>
            <a href="Pesquisa_med.php">Pesquisar</a>
            <a href="Consultar.php">Histórico</a>
            <a href="Criadoras.html">Criadoras</a> 
            <a href="perfil.php"  class="active">Perfil</a>        
     </nav>

        </button>
        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
    </header>

<main class="perfil-page">

    <section class="perfil-container">

        <!-- LADO ESQUERDO -->

        <aside class="perfil-card">

            <div class="perfil-avatar">
                👤
            </div>

<h1><?php echo htmlspecialchars($sqlMedico["usuario"]);?></h1>
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
    <input
        type="text"
        value="<?php echo htmlspecialchars($sqlMedico["nome"]); ?>"
        readonly>
</div>

<div class="perfil-input">
    <label>Usuário</label>
    <input
        type="text"
        value="<?php echo htmlspecialchars($sqlMedico["usuario"]); ?>"
        readonly>
</div>
<div class="perfil-input">
    <label>E-mail</label>
    <input
        type="email"
        value="<?php echo htmlspecialchars($sqlMedico["email"]); ?>"
        readonly>
</div>

<div class="perfil-input">
    <label>CRM</label>
    <input
        type="text"
        value="<?php echo htmlspecialchars($sqlMedico["crm"]); ?>"
        readonly>
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