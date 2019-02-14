<?php 
App::import('Vendor','xtcpdf');  

define ('PDF_HEADER_STRING', "" );

$tcpdf = new XTCPDF(); 
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ClicAdministration');
$pdf->SetTitle('Demande '.$absence['Absence']['id']);
$pdf->SetSubject('Demande '.$absence['Absence']['id']);
// $pdf->SetKeywords('ClicAdministration');

// set default header data
$pdf->SetHeaderData("logo.png", PDF_HEADER_LOGO_WIDTH, "", PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

//$html = $htmlcleaner->cleanup( $this->element('demandeAbsence')) ;
//echo $html ;
$html = $this->element('demandeAbsence') ;
// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, 0, true, 0);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
if(!$download)
	$pdf->Output("Demande_Absence_".$absence['Member']['nom']."_".$absence['Member']['prenom']."_".$absence['Absence']['id'].".pdf", "F");
else
	$pdf->Output("Demande_Absence_".$absence['Member']['nom']."_".$absence['Member']['prenom']."_".$absence['Absence']['id'].".pdf", "I");