<?php
//call the FPDF library
require('fpdf17/fpdf.php');

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'basedatosebaf');
class PDF extends FPDF{
    function Header(){
        $con=mysqli_connect('localhost','root','');
        mysqli_select_db($con,'basedatosebaf');
        $query=mysqli_query($con,"select * from entrega where fechaEntrega=CURRENT_DATE()");
        $data=mysqli_fetch_array($query);
        $this->Image('eba_fondo.png',10,10,189);
        $this->setFont('Arial','B',15);
        $this->Image('eba_logo.png',20,20,20,20);
        $this->Cell(80);
        $this->Cell(50,10,'REPORTE DIARIO',0,1,'R');
        $this->Cell(60,10,$data['fechaEntrega'],0,0,'R');
        $this->Ln(30);
        $this->setFont('Arial','B',10);
        $this->SetFillColor(180,180,255);
        $this->SetDrawColor(50,50,100);
        $this->Cell(10,5,'NRO',1,0,'',true);
        $this->Cell(20,5,'CANTIDAD',1,0,'',true);

        $this->Cell(160,5,'PAQUETE',1,1,'',true);
    }
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new PDF('P','mm','A4');
//add new page
$pdf->AddPage();
//set font to arial, bold, 14pt
$amount=0;
$c=1;
$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(50,50,100);
$query=mysqli_query($con,"select ent.cantidad as cantidad, ent.fechaEntrega as fecha, paq.descripcion as paquete from entrega as ent, paquete as paq where ent.paqueteid=paq.paqueteid AND ent.fechaEntrega=CURRENT_DATE()");
while ($data=mysqli_fetch_array($query)){
    $pdf->Cell(10,5,$c,1,0);
    $pdf->Cell(20,5,$data['cantidad'],1,0);
    $pdf->Cell(160,5,$data['paquete'],1,1);
    $c ++;
}



//Cell(width , height , text , border , end line , [align] )

//output the result
$pdf->Output();

?>