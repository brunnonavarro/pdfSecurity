<?php

require 'transparency.php';

$caminhoArquivo = 'C:\Users\Piolho\Desktop\LivrosBC\testeconvertido.pdf';
$cpf = "000.000.000-00";
$senha = "123";

$pdf = new AlphaPDF();
$pdf->AddPage('P','A4','');
$pdf->SetProtection(array(),$senha,'');
$pdf->setSourceFile($caminhoArquivo);
$pageCount = $pdf-> setSourceFile($caminhoArquivo);

for ($numeroPagina = 1; $numeroPagina < $pageCount; $numeroPagina++)
{   
    $tplIdx = $pdf->importPage($numeroPagina);
    $pdf->useTemplate($tplIdx,0,0,190,280,true);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->SetAlpha(0.3);

    $pdf->setFont('Arial','B',48);
    $pdf->RotatedText(70,210,'LICENCIADO PARA:',60);
    $pdf->RotatedText(100,195,$cpf,60);
    $pdf-> AddPage();

}

$pdf->Output();

?>