<?php
include("../../files/config.php");
include("DbConnection.php");
include("TableView.php");
include_once("Classes/PHPExcel.php");
$dbconnect -> connect($DBuser, $DBpass, $DBurl );
$dbconnect -> useDb($Database);		
require_once('Library/tcpdf-master/tcpdf.php');
session_start();
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('StockEye Development');
$pdf->SetTitle('Constant Energy Source');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$name = $_SESSION["EmpName"];
$pdf->SetHeaderData("Logo.jpg", PDF_HEADER_LOGO_WIDTH, "Constant Energy Source", "www.Constant-Energysource.com \n                                                                                                    Date: ".$date = date('F d Y',time()), array(0,0,0), array(0,0,0));
$pdf->setFooterData("asdasdsds",array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$date = date('F Y',time());


// Set some content to print

$html = "Inventory Warehouse as of ".$date."<br><br>" ;
$tbl_header = '<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    margin: 0 20px;
}
tr {
    padding: 3px 0;
}

th {
    background-color: #CCCCCC;
    border: 1px solid #DDDDDD;
    color: #333333;
    font-family: trebuchet MS;
    font-size: 15px;
    padding-bottom: 4px;
    padding-left: 6px;
    padding-top: 5px;
    text-align: left;
}
td {
    border: 1px solid #CCCCCC;
    font-size: 10px;
    padding: 3px 2px 3px;
}
</style>
<table  width="600" cellspacing="2" cellpadding="1" border="0">
<tr>
        <th><font face="Arial, Helvetica, sans-serif">Item Code</font></th>
        <th><font face="Arial, Helvetica, sans-serif">Item Name</font></th>
        <th><font face="Arial, Helvetica, sans-serif">Quantity</font></th>
        <th><font face="Arial, Helvetica, sans-serif">Amount Per Unit</font></th>
		 <th><font face="Arial, Helvetica, sans-serif">Amount</font></th>
      </tr>';
$tbl_footer = '</table>';
$tbl='';
$totalAmount='';

$query = mysql_query("SELECT * FROM item_table;");
				while($result = mysql_fetch_array($query)){			
					
				
					if($result['status']=="active"){
						$itemid = $result['item_id'];
						$itemcode= $result['item_code'];
						$itemname = $result['item_name'];
						$quantity = $result['quantity'];
						$bQuantity = $result['baseline_quantity'];
						$unitprice = $result['unit_price'];
						$totalprice = $unitprice * $quantity;
						
					
							$tbl .='<tr>'.
								'<td>' . $itemcode . '</td>'.
								'<td>' . $itemname . '</td>'.
								'<td>' . $quantity . '</td>'.
								'<td>' . number_format($unitprice,2) . '</td>'.
								'<td>' . number_format($totalprice,2) . '</td>'.
								
								'</tr>';
						$totalAmount =$totalAmount + $totalprice;
					}
				}


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, -1, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
$html2 = '<span style="font-size: xx-small;margin-left:50px;">Total Amount in Inventory: &nbsp;<b>'.number_format($totalAmount,2).'</b></span><br><br>';
$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->writeHTMLCell(0, 0, '', '',"Statistics<br>", 0, 1, 0, true, '', true);
$html2 = '<span style="font-size: xx-small;margin-left:50px;">Total Number of Reports for the Month: &nbsp;<b></span>';

$query = mysql_query("SELECT * FROM supply_orders_table WHERE extract(month from time)= MONTH(NOW()) AND extract(year from time) = YEAR(NOW());");

	$num = mysql_num_rows($query);

$html2 = '<span style="font-size: xx-small;margin-left:50px;">Total Number of Reports for the Month: &nbsp; &nbsp; &nbsp; &nbsp;'.$num.' &nbsp;<b></span>';
$pdf->writeHTML($html2, true, false, true, false, '');



$query_deposit = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deposited' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");

	$num = mysql_num_rows($query_deposit);

$html2 = '<span style="font-size: xx-small;margin-left:50px;">Deposits for the Month: &nbsp; &nbsp; &nbsp; &nbsp;'.$num.' &nbsp;<b></span>';
$pdf->writeHTML($html2, true, false, true, false, '');



$query_withdraw = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deducted' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");

	$num = mysql_num_rows($query_withdraw);

$html2 = '<span style="font-size: xx-small;margin-left:50px;">Withdraws for the Month: &nbsp; &nbsp; &nbsp; &nbsp;'.$num.' &nbsp;<b></span>';
$pdf->writeHTML($html2, true, false, true, false, '');



		$totalAmount='';
			$query_withdraw2 = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deducted' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");
			while($result3 = mysql_fetch_array($query_withdraw2)){
				$item_name2 = $result3['Item_Name'];
				$user2 = $result3['User'];
				$amount = $result3['Quantity'];
				$query =mysql_query("SELECT * FROM item_table where item_name='$item_name2'");
				$result = mysql_fetch_array($query);
				$cost = $amount * $result['unit_price'];
				$totalAmount = $totalAmount + $cost;
				
			}

$html2 = '<span style="font-size: xx-small;margin-left:50px;">Total Cost of Withdrewn Items for the Month: &nbsp; &nbsp; &nbsp; &nbsp;'.number_format($totalAmount,2).' &nbsp;<b></span>';
$pdf->writeHTML($html2, true, false, true, false, '');


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>