<?php

require 'transparency.php';

$caminhoArquivo = 'C:\Users\Piolho\Desktop\LivrosBC\testeconvertido.pdf';
$cpf = "000.000.000-00";
$senha = "123";
// o código abaixo não altera um pdf em si, o que ele faz é criar um novo arquivo PDF a partir de um PDF já existende. 
// Além de criar o novo arquivo, ele insere marca d'agua de acordo com o que o usuário necessita, basta editar os parâmetros.
// Todas as bibliotecas usadas se encontram no arquivo composer.json
$pdf = new AlphaPDF();
$pdf->AddPage('P','A4','');
$pdf->SetProtection(array(),$senha,'');
$pdf->setSourceFile($caminhoArquivo);
$pageCount = $pdf-> setSourceFile($caminhoArquivo);



for ($numeroPagina = 1; $numeroPagina < $pageCount; $numeroPagina++)
{   
    $pdf->SetAlpha(1);
    $alturaTextCorpo = rand(20,250);
    $tplIdx = $pdf->importPage($numeroPagina);
    $pdf->useTemplate($tplIdx,0,0,190,280,true);


    if ($numeroPagina % 2 == 0){

        $posicaoTextoBorda = rand(0,1);
        $pdf->SetAlpha(0.4);
        
        if ($posicaoTextoBorda == 0) {
            //posição 2
            $pdf->setFont('Arial','B',14);
            $pdf->RotatedText(120,10,'LICENCIADO PARA:',0);
            $pdf->RotatedText(125,15,$cpf,0);  
        
        } elseif ($posicaoTextoBorda == 1) {
            //posição 4
            $pdf->setFont('Arial','B',14);
            $pdf->RotatedText(120,270,'LICENCIADO PARA:',0);
            $pdf->RotatedText(125,275,$cpf,0);
        }

    }
    else {
        $posicaoTextoBorda = rand(0,1);
        $pdf->SetAlpha(0.4);

        if ($posicaoTextoBorda == 0){
            //posição 1
            $pdf->setFont('Arial','B',14);
            $pdf->RotatedText(20,10,'LICENCIADO PARA:',0);
            $pdf->RotatedText(25,15,$cpf,0);

        } elseif ($posicaoTextoBorda == 1) {
            //posição 3
            $pdf->setFont('Arial','B',14);
            $pdf->RotatedText(20,270,'LICENCIADO PARA:',0);
            $pdf->RotatedText(25,275,$cpf,0);
        }
    }
    
    $pdf-> AddPage();
}

$pdf->Output();

?>