<?php
//call the FPDF library
require('fpdf17/fpdf.php');
//'".$_GET['pedidoid']"'");

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'basedatosebaf');

class PDF extends FPDF{
    function Header(){
        $con=mysqli_connect('localhost','root','');
        mysqli_select_db($con,'basedatosebaf');
        $pee=1;
        $query=mysqli_query($con,"select ped.pedidoid as idpedido, pro.proveedorid as idproveedor, pvr.nombre as nombre, 
                                        ped.fechaEntrega as fecha, ped.vigencia as vigencia 
                                        from pedido as ped, proveedor as pvr, producto as pro 
                                        where ped.productoid=pro.productoid AND pvr.proveedorid=pro.proveedorid AND ped.pedidoid=1");
        $data=mysqli_fetch_array($query);
        $this->Image('eba_fondo.png',10,10,189);
        $this->setFont('Arial','B',15);
        $this->Image('eba_logo.png',20,20,20,20);
        $this->Cell(80);
        $this->Cell(50,10,'COMPROBANTE DE INGRESO DE PRODUCTOS',0,1,'R');
        $this->Cell(60);
        $this->Ln(10);

        $this->setFont('Arial','B',10);
        $this->Cell(100,10,'',0,0);
        $this->Cell(15,10,'Vigencia: ',0,0);
        $this->Cell(50,10,$data['vigencia'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Id Pedido: ',0,0,'C');
        $this->Cell(30,5,$data['idpedido'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Id Proveedor: ',0,0,'C');
        $this->Cell(30,5,$data['idproveedor'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Nombre Proveedor: ',0,0,'C');
        $this->Cell(30,5,$data['nombre'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Fecha entrega: ',0,0,'C');
        $this->Cell(30,5,$data['fecha'],0,1);

        $this->SetFillColor(180,180,255);
        $this->SetDrawColor(50,50,100);
        $this->Cell(10,5,'NRO',1,0,'',true);
        $this->Cell(20,5,'Id ARTICULO',1,0,'',true);
        $this->Cell(60,5,'DESCRIPCION',1,0,'',true);
        $this->Cell(20,5,'CANTIDAD',1,0,'',true);
        $this->Cell(20,5,'PRECIO',1,0,'',true);
        $this->Cell(50,5,'TOTAL',1,1,'',true);
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
$query=mysqli_query($con,"select pro.productoid as idarticulo, pro.nombre as descripcion, ped.cantidad as cantidad, pro.precioCompra as precio 
                                        from pedido as ped, proveedor as pvr, producto as pro 
                                        where ped.productoid=pro.productoid AND pvr.proveedorid=pro.proveedorid AND ped.pedidoid=1");
                                        
while ($data=mysqli_fetch_array($query)){
    $amount=$data['cantidad']*$data['precio'];
    $pdf->Cell(10,5,$c,1,0);
    $pdf->Cell(20,5,$data['idarticulo'],1,0);
    $pdf->Cell(60,5,$data['descripcion'],1,0);
    $pdf->Cell(20,5,$data['cantidad'],1,0);
    $pdf->Cell(20,5,$data['precio'],1,0);
    $pdf->Cell(50,5,$amount,1,1);
    $c ++;
}

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(20,5,'total',1,0);
$pdf->Cell(20,5,$amount,1,0);

//Cell(width , height , text , border , end line , [align] )

//output the result
$pdf->Output();

?>