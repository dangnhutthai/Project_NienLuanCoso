<?php
require_once '../../tfpdf/tfpdf.php';
require_once '../../../bootstrap.php';

$pdf = new tFPDF();
$pdf->AddPage("0");
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->SetFillColor(193, 229, 252);
$code = $_GET['idorder'];

$sql = "SELECT * FROM tbl_sanpham, tbl_cart_details WHERE tbl_sanpham.id_sanpham = tbl_cart_details.id_sanpham
AND tbl_cart_details.code_cart = $code";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$pdf->Write(10,'Đơn hàng của bạn gồm có:');
	$pdf->Ln(10);
	$width_cell=array(10,35,90,34,35,50);

	$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
	$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
	$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
	$pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
	$pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
	$pdf->Cell($width_cell[5],10,'Tổng tiền',1,1,'C',true); 
	$pdf->SetFillColor(235,236,236); 
	$fill=false;
	$i = 0;
	while($row = $stmt->fetch()){
		$i++;
	$pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['code_cart'],1,0,'C',$fill);
	$pdf->Cell($width_cell[2],10,$row['tensanpham'],1,0,'C',$fill);
	$pdf->Cell($width_cell[3],10,$row['soluongmua'],1,0,'C',$fill);
	$pdf->Cell($width_cell[4],10,number_format($row['gia_sale']),1,0,'C',$fill);
	$pdf->Cell($width_cell[5],10,number_format($row['soluongmua']*$row['gia_sale']),1,1,'C',$fill);
	$fill = !$fill;

	}
	$pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
	$pdf->Ln(10);
$pdf->Output();

?>