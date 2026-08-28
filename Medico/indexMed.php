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


    <!-- HERO SECTION -->
    <section class="hero">

        <!-- LADO ESQUERDO -->
        <div class="hero-left">
            <span class="tag">Tecnologia em prol da vida</span>

            <h1>Identificação Inteligente de Melanoma.</h1>

            <p>
                O projeto SKIA une redes neurais avançadas e conhecimento dermatológico 
                para fornecer ferramentas educacionais de triagem e prevenção do câncer de pele.
            </p>

            <div class="buttons">
                <button class="primary"> <a href="SKIA.html">Conheça o Projeto</a></button>
            </div>
        </div>
<br>

        <!-- LADO DIREITO -->
        <div class="hero-right">
            <div class="login-card">
                <h1>Sair da Plataforma</h1>
<br>
                <p>Obrigado por usar nossos serviços.</p>

<br>
        <div class="buttons">
            <button class="primary_2" onclick="window.location.href='/TCC/Geral/PHP/logout.php'"> Sair da Conta →</button>
       

            </div>
<br>
                <button class="secondary">
                    Ao sair, você precisará logar novamente.
                </button>
            </div>
        </div>

    </section>


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