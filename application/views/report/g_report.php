<?php


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Cavin Pabua');
$pdf->SetTitle('Purchase Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('head.jpg', PDF_HEADER_LOGO_WIDTH, 'USTP MEMBERSHIP SHOPPING', 'Inventory and Management System');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
$title = '<b style="font-size:30px;">PURCHASE REPORT</b>';
$dateGen = 'DATE GENERATED<br>'.date("F j, Y");
$table .= '<h1>Order Details</h1>
			<br>
			<table style=" padding:6px;">';
$table .= '<tr>
			<th style="border:1px solid #000;"><b>SUPPLIER NAME</b></th>
			<th style="border:1px solid #000;"><b>STOCK ITEM</b></th>
			<th style="border:1px solid #000;"><b>QUANTITY</b></th>
			<th style="border:1px solid #000;"><b>PURCHASE PRICE</b></th>
			<th style="border:1px solid #000;"><b>SELLING PRICE</b></th>
			<th style="border:1px solid #000;"><b>LINE TOTAL</b></th>
		</tr>';
foreach ($purchase_detail as $row) {
	$table .= '<tr>';
			foreach ($supplier_info as $id) {
				if(($id->supplier_id) == ($row->supplier_id)){
				$table .= '<td style="border:1px solid #000;">'.$id->supplier_name.'</td>';
			}}
			foreach ($product_info as $prod_name) {
				if(($prod_name->product_id) == ($row->product_id)){
				$table .= '<td style="border:1px solid #000;">'.$prod_name->product_name.'</td>';
			}}
	  	
	$table.=' 	<td style="border:1px solid #000;">'.$row->qty_IN.'</td>
				<td style="border:1px solid #000;">PHP'.$row->purchase_price.'</td>
				<td style="border:1px solid #000;">PHP'.$row->selling_price.'</td>
				<td style="border:1px solid #000;">PHP'.$row->total_amount.'</td>
			</tr>';
}
$table .='
			<tr>
			<th style="text-align:right;" colspan="5"><b>SUB-TOTAL</b></th>
			<td style="border:1px solid #000;">PHP'.$purchase_order_id->total_amount.'</td>
			</tr>
			<tr>
			<th style="text-align:right;" colspan="5"><b>PAYMENT</b></th>
			<td style="border:1px solid #000;">PHP'.$purchase_order_id->total_payment.'</td>
			</tr>
			<tr>
			<th style="text-align:right;" colspan="5"><b>TOTAL/BALANCE</b></th>
			<td style="border:1px solid #000;">PHP'.$purchase_order_id->total_balance.'</td>
			</tr>
			
';
$txt = 'PURCHASE ID: '.$purchase_order_id->purchase_id;
$dateOrdTitle = 'DATE ORDERED';
$dateOrd=date("F j, Y",strtotime($purchase_order_id->Date_Ordered));
$table .='</table>';
$pdf->WriteHTMLCell(0,0,'','',$title,0,1,0,true,'L',true);

$pdf->WriteHTMLCell(0,0,'','',$dateGen,0,1,0,true,'R',true);
$pdf->MultiCell(50, 5, $txt."\n", 1, 'J', 1, 1, '' ,'', true);
$pdf->MultiCell(50, 5, $dateOrdTitle, 0, 1, 0, 1, 163 ,60, true);

$pdf->MultiCell(50, 5, $dateOrd, 0, 3, 0, 1, 167 ,65, true);
$pdf->WriteHTMLCell(0,0,'','',$table,0,1,0,true,'C',true);
//Close and output PDF document
ob_clean();
$pdf->Output('purchase_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
