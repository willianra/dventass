<?php
//call the FPDF library
require('fpdf17/fpdf.php');

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'basedatosebaf');
class PDF extends FPDF{
    function Header(){
        $con=mysqli_connect('localhost','root','');
        mysqli_select_db($con,'basedatosebaf');

        $query=mysqli_query($con,"select DISTINCT emp.nombreComercial as empresa, per.nombre as nombre, per.paterno as paterno, per.materno as materno, per.ci as ci, ent.cantidad as cantidad, ent.fechaEntrega as fecha, paq.descripcion as nombrepaquete,
                                         ent.paqueteid as paquete, ent.entregaid as entrega
                                         from entrega as ent, paquete as paq, planificacion as pla, persona as per, personalsucursal as psl, sucursal as suc,
                                          empresa as emp where entregaid=1 AND paq.paqueteid=ent.paqueteid AND ent.planificacionid=pla.planificacionid AND 
                                          pla.trabajadorid=per.personaid AND per.personaid=psl.idpersona AND psl.idsucursal=emp.empresaid");
        $data=mysqli_fetch_array($query);
        $this->Image('eba_fondo.png',10,10,189);
        $this->setFont('Arial','B',15);
        $this->Image('eba_logo.png',20,20,20,20);
        $this->Cell(80);
        $this->Cell(50,10,'NOTA DE ENTREGA SUBSIDIO',0,1,'R');
        $this->Cell(60);
        $this->Ln(10);

        $this->setFont('Arial','B',10);
        $this->Cell(100,10,'',0,0);
        $this->Cell(15,10,$data['paquete'],0,0);
        $this->Cell(50,10,$data['nombrepaquete'],0,1);

        $this->setFont('Arial','B',8);
        $this->Cell(120);
        $this->Cell(30,5,'CODIGO: ',0,0,'R');
        $this->Cell(40,5,$data['entrega'],1,1,'C');
        $this->Ln(5);

        $this->Cell(10);
        $this->Cell(30,5,'Empresa: ',0,0,'C');
        $this->Cell(30,5,$data['empresa'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Empleado: ',0,0,'C');
        $this->Cell(15,5,$data['nombre'],0,0);
        $this->Cell(15,5,$data['paterno'],0,0);
        $this->Cell(15,5,$data['materno'],0,0);
        $this->Cell(25);
        $this->Cell(30,5,'CI: ',0,0,'R');
        $this->Cell(30,5,$data['ci'],0,1);
        $query2=mysqli_query($con,"select DISTINCT per.nombre as nombre, per.paterno as paterno,  per.materno as materno, per.ci as ci 
                                          from persona as per, avala as ava, planificacion as pla, entrega as ent 
                                          where per.personaid=1 ");
        $data2=mysqli_fetch_array($query2);


        $this->Cell(10);
        $this->Cell(30,5,'Entregado a: ',0,0,'C');
        $this->Cell(15,5,$data2['nombre'],0,0);
        $this->Cell(15,5,$data2['paterno'],0,0);
        $this->Cell(15,5,$data2['materno'],0,0);
        $this->Cell(25);
        $this->Cell(30,5,'CI: ',0,0,'R');
        $this->Cell(30,5,$data2['ci'],0,1);

        $this->Cell(10);
        $this->Cell(30,5,'Cantidad de Paquetes: ',0,0,'C');
        $this->Cell(30,5,$data['cantidad'],0,0);
        $this->Cell(30);
        $this->Cell(30,5,'FECHA: ',0,0,'R');
        $this->Cell(30,5,$data['fecha'],0,1);

        $this->SetFillColor(180,180,255);
        $this->SetDrawColor(50,50,100);
        $this->Cell(10,5,'NRO',1,0,'',true);
        $this->Cell(20,5,'CANTIDAD',1,0,'',true);
        $this->Cell(20,5,'PRECIO',1,0,'',true);
        $this->Cell(140,5,'NOMBRE DEL PRODUCTO',1,1,'',true);
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
$query=mysqli_query($con,"select paq.paqueteid as paquete, dpaq.cantidad*e.cantidad as cantidad, pro.precioVenta*dpaq.cantidad*e.cantidad as precio, pro.nombre as nombre 
                                from entrega as e, paquete as paq, detallepaquete as dpaq, producto as pro
                                where e.paqueteid=paq.paqueteid AND paq.paqueteid=dpaq.paqueteid AND dpaq.productoid=pro.productoid AND e.entregaid=1");
while ($data=mysqli_fetch_array($query)){
    $pdf->Cell(10,5,$c,1,0);
    $pdf->Cell(20,5,$data['cantidad'],1,0);
    $pdf->Cell(20,5,$data['precio'],1,0);
    $pdf->Cell(140,5,$data['nombre'],1,1);
    $amount += $data['precio'];
    $c ++;
}

$pdf->Cell(10,5,'',0,0);
$pdf->Cell(20,5,'total',1,0);
$pdf->Cell(20,5,$amount,1,0);

//Cell(width , height , text , border , end line , [align] )

//output the result
$pdf->Output();

?>