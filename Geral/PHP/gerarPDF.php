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

require_once("conexao.php");
require_once(__DIR__ . "/../../FPDF/fpdf.php");

if (!isset($_GET["id"])) {
    die("Resultado não encontrado.");
}

$idImagem = $_GET["id"];

$sql = $conn->prepare("
SELECT
    imagem.*,
    paciente.nome AS paciente,
    medico.nome AS medico,
    laudo.descricao,
    laudo.data_laudo
FROM imagem
INNER JOIN paciente
    ON imagem.id_paciente = paciente.id_paciente
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

/* ======================
   PDF
====================== */

$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetTitle(mb_convert_encoding("Resultado SKIA", "ISO-8859-1", "UTF-8"));

$pdf->SetFont('Arial','B',18);
$pdf->Cell(
    0,
    12,
    mb_convert_encoding("SKIA", "ISO-8859-1", "UTF-8"),
    0,
    1,
    'C'
);

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding("Relatório de Análise Dermatológica", "ISO-8859-1", "UTF-8"),
    0,
    1,
    'C'
);

$pdf->Ln(8);

/* Paciente */

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Paciente:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding($dados["paciente"], "ISO-8859-1", "UTF-8"),
    0,
    1
);

/* Médico */

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Médico:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding($dados["medico"], "ISO-8859-1", "UTF-8"),
    0,
    1
);

/* Arquivo */

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Arquivo:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding($dados["nome_arquivo"], "ISO-8859-1", "UTF-8"),
    0,
    1
);

/* Status */

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Status:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding($dados["status"], "ISO-8859-1", "UTF-8"),
    0,
    1
);

/* Datas */

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Data do envio:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    date("d/m/Y H:i", strtotime($dados["data_envio"])),
    0,
    1
);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(50,8,"Data da análise:");

$pdf->SetFont('Arial','',12);
$pdf->Cell(
    0,
    8,
    date("d/m/Y H:i", strtotime($dados["data_laudo"])),
    0,
    1
);

$pdf->Ln(10);

/* Diagnóstico */

$pdf->SetFont('Arial','B',13);
$pdf->Cell(
    0,
    8,
    mb_convert_encoding("Diagnóstico Médico", "ISO-8859-1", "UTF-8"),
    0,
    1
);

$pdf->SetFont('Arial','',12);

$pdf->MultiCell(
    0,
    8,
    mb_convert_encoding($dados["descricao"], "ISO-8859-1", "UTF-8")
);

$pdf->Ln(10);

/* Aviso */

$pdf->SetFont('Arial','I',10);

$pdf->MultiCell(
    0,
    6,
    mb_convert_encoding(
        "Aviso: Este documento foi gerado pelo sistema SKIA e possui finalidade informativa. Ele não substitui uma consulta ou diagnóstico médico profissional.",
        "ISO-8859-1",
        "UTF-8"
    )
);

$pdf->Output("I", "Resultado_SKIA.pdf");

?>