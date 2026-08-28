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
    <link rel="stylesheet" href="../Style/stylemed3.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div><img
    src="../Imagens/Logo_sem_Fundo.png"
    alt="Logo SKIA"
    class="logo-central"
></div>

        <nav>
            <a href="indexMed.php" >Inicio</a>
            <a href="Skia_med.php" class="active">SKIA-IA</a>
            <a href="Pesquisa_med.php">Pesquisar</a>
            <a href="Consultar.php">Histórico</a>
            <a href="Criadoras.html">Criadoras</a> 
            <a href="perfil.php">Perfil</a>        
     </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">Sair</a>
    </header>


    <!-- MAIN -->
    <main class="ia-page">

        <div class="ia-container">

            <!-- CARD ESQUERDO -->
            <section class="ia-left">

                <img
    src="../Imagens/Logo_sem_Fundo.png"
    alt="Logo SKIA"
    class="logo-central"
>

                <div class="mini-line"></div>

                <p>
                    Sua plataforma inteligente para apoio em dermatologia,
                    com tecnologia e ciência a favor da sua prática.
                </p>

            </section>

            <!-- CARD DIREITO -->
            
            <section class="skia-ia-page-right">

    <div class="skia-ia-intro">

        <h2> SKIA-IA</h2>

        <p>
            A SKIA-IA é uma ferramenta desenvolvida para auxiliar profissionais da saúde,
            oferecendo suporte à análise de imagens dermatológicas por meio da Inteligência
            Artificial. Seu objetivo é contribuir para a avaliação clínica, fornecendo
            informações que auxiliem o profissional durante o processo de triagem.
        </p>

    </div>

    <div class="skia-ia-card">

        <h3> Como funciona?</h3>

        <p>
            A SKIA-IA identifica padrões em imagens dermatológicas, analisando
            características visuais que podem estar associadas a lesões cutâneas.
            As informações apresentadas servem como apoio à avaliação clínica
            realizada pelo médico.
        </p>

    </div>

    <div class="skia-ia-card">

        <h3> Objetivo</h3>

        <p>
            Auxiliar profissionais da saúde durante a triagem e organização da
            análise de imagens, tornando o processo mais prático e contribuindo
            para a tomada de decisão clínica.
        </p>

    </div>

    <div class="skia-ia-card">

        <h3> Importante</h3>

        <p>
            Os resultados apresentados possuem caráter informativo e não
            substituem o diagnóstico médico. A interpretação clínica continua
            sendo responsabilidade exclusiva do profissional da saúde.
        </p>

    </div>

    <div class="skia-ia-card">

        <h3> Projeto Científico</h3>

        <p>
            A SKIA-IA integra um projeto científico e educacional voltado à
            aplicação da Inteligência Artificial na área da saúde, incentivando
            o uso ético e responsável da tecnologia.
        </p>

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