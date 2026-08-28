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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKIA - Enviar Imagem</title>

    <link rel="stylesheet" href="../Style/stylePacEnv.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <!-- HEADER -->

    <header>

        <div class="logo-container">
            <img
                src="../Imagens/Logo_sem_Fundo.png"
                alt="Logo SKIA"
                class="logo">
        </div>

        <nav>

            <a href="index.php">Início</a>
            <a href="SKIA.html">SKIA-IA</a>
            <a href="Melanoma.html">Melanoma</a>
            <a href="Prevencao.html">Prevenção</a>
            <a href="tratamento.html">Tratamento</a>
            <a href="Criadoras.html">Criadoras</a>
            <a href="Paulinia.html">Paulínia</a>
            <a href="enviarImg.php" class="active">Enviar</a>
            <a href="Historico.php">Histórico</a>
            <a href="perfil.php">Perfil</a>

        </nav>

        <a href="/TCC/Geral/PHP/logout.php" class="logout-btn">
            Sair
        </a>

    </header>

    <!-- CONTEÚDO -->

    <main class="enviar-page">

        <div class="enviar-container">

            <!-- PERFIL -->

            <aside class="enviar-perfil-card">

                <div class="enviar-perfil-icon">
                    👤
                </div>

                <h1>
                    <?php echo $_SESSION["nome"]; ?>
                </h1>

                <div class="enviar-linha"></div>

                <p>
                    Área destinada ao envio de imagens para análise médica.
                    Após o envio, um médico poderá avaliar a lesão e emitir
                    um laudo.
                </p>

                <button
                    class="enviar-editar-btn"
                    onclick="window.location.href='perfil.php'">

                    Editar Perfil

                </button>

            </aside>

            <!-- CARD PRINCIPAL -->

            <section class="enviar-card">

                <div class="enviar-titulo">

                    <h2>Nova Solicitação</h2>

                    <p>
                        Envie uma fotografia da lesão para análise.
                        Após o envio, um dermatologista poderá avaliar
                        a imagem e emitir um parecer.
                    </p>

                </div>

                <div class="enviar-info">

                    <div class="enviar-info-icon">
                        <span>📷</span>
                    </div>

                    <div>

                        <h3>Enviar imagem</h3>

                        <p>
                            São aceitos arquivos JPG, JPEG e PNG.
                        </p>

                    </div>

                </div>

                <!-- FORM -->

                <form
                    class="enviar-form"
                    action="../Geral/PHP/uploadImagem.php"
                    method="POST"
                    enctype="multipart/form-data">

                    <!-- PREVIEW -->

                    <div class="enviar-preview">

                        <img
                            id="previewImagem"
                            src=""
                            alt="Prévia da imagem">

                        <p id="nomeArquivo">
                            Nenhuma imagem selecionada.
                        </p>

                    </div>

                    <!-- INPUT -->

                    <label class="enviar-input">

                        <input
                            type="file"
                            id="imagem"
                            name="imagem"
                            accept=".jpg,.jpeg,.png"
                            required>

                    </label>

                    <!-- BOTÃO -->

                    <button
                        type="submit"
                        class="enviar-btn">

                        Enviar Solicitação

                    </button>

                </form>

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

    <!-- SCRIPT -->

    <script>

        const input = document.getElementById("imagem");
        const preview = document.getElementById("previewImagem");
        const nomeArquivo = document.getElementById("nomeArquivo");

        input.addEventListener("change", function () {

            const arquivo = this.files[0];

            if (!arquivo) return;

            nomeArquivo.textContent = arquivo.name;

            const leitor = new FileReader();

            leitor.onload = function (e) {

                preview.src = e.target.result;
                preview.style.display = "block";

            };

            leitor.readAsDataURL(arquivo);

        });

    </script>

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