<?php

session_start();

// Apaga todas as variáveis da sessão
session_unset();

// Encerra a sessão
session_destroy();

// Volta para a tela de login
header("Location: /TCC/Geral/Conta.html");
exit();

?>