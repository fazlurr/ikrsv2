<?php
require('fpdf.php');
//most of the entries here are self explanatory, PHP advance scripting knowledge preferred. If any doubts please let us know through your comments in http://mistonline.in/wp/export-mysql-database-table-to-pdf-using-php-2/
$d=date('d_m_Y');
//Modified by mistonline team

class PDF extends FPDF
{

function Header()
{
    //Logo
	$name="Testing PDF Creation";
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(20,40,"Data Generated For $name on ".date('d-m-Y'),0,0,'C');
	$this->SetFont('Arial','B',9);
	$this->Cell(10,60,"Test Place 1",0,0,'C');
	$this->Cell(-10,70,"Test Place 2",0,0,'C');
    //Line break
    $this->Ln(20);
}

//Page footer
function Footer()
{
   
}

//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}


//Simple table
function BasicTable($header,$data)
{ 

$this->SetFillColor(255,0,0);
$this->SetDrawColor(128,0,0);
$w=array(30,15,20,10,10,10,10,10,15,15,15,15,15);

	//Header
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
	//Data
	foreach ($data as $eachResult) 
	{ //width
		$this->Cell(30,6,$eachResult["Manager"],1);
		$this->Cell(15,6,$eachResult["Date"],1);
		$this->Cell(20,6,$eachResult["Trans_Data"],1);
		$this->Cell(10,6,$eachResult["Failed_Trans"],1);
		$this->Cell(10,6,$eachResult["Banks_Trans"],1);
		$this->Ln();
		 	 	 	 	
	}
}


//Better table
}

$pdf=new PDF();
$header=array('Name','Date','Transaction Data','Failed Trasactions','Banks Transffered');
//Data loading
//*** Load MySQL Data ***//
$objConnect = mysql_connect("localhost","root","") or die("Error:Please check your database username & password");
$objDB = mysql_select_db("rpl");
$strSQL = "SELECT * FROM krs WHERE user_id = 'test'";
$objQuery = mysql_query($strSQL);
$resultData = array();
for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
	$result = mysql_fetch_array($objQuery);
	array_push($resultData,$result);
}
//************************//


function forme() {
	$d=date('d_m_Y');
	echo "Data generated succesfully. Download it here <a href=".$d.".pdf>DOWNLOAD</a>";
}


$pdf->SetFont('Arial','',6);

//*** Table 1 ***//
$pdf->AddPage();
$pdf->Image('logo-iti.jpg',80,8,33);
$pdf->Ln(35);
$pdf->BasicTable($header,$resultData);
forme();
$pdf->Output("$d.pdf","F");?>
