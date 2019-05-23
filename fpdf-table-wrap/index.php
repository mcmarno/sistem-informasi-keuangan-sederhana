<?php  

require_once("fpdf17/fpdf.php");
include_once("../config.php");
                                        // Fetch all users data from database
if(isset($_GET['cari'])){
	$cari1 = $_GET['cari1'];
	$cari2 = $_GET['cari2'];
	$a = empty($_GET['cari1']);
	$b = empty($_GET['cari2']);
	if ($a AND $b) {
		$result = mysqli_query($conn, "SELECT * FROM tb_kas ORDER BY id_kas ASC");
		$debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas");
		$kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas");
	}else{
		$result = mysqli_query($conn, "SELECT * FROM tb_kas WHERE tanggal BETWEEN '$cari1' AND '$cari2' ORDER BY id_kas ASC");
		$debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas where tanggal BETWEEN '$cari1' AND 'cari2'");
		$kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas where tanggal BETWEEN '$cari1' AND '$cari2'");	
	}
}

$datadebit = mysqli_fetch_array($debit);
$datakredit = mysqli_fetch_array($kredit);
$jumlahdebit = $datadebit['jumlah'];
$jumlahkredit = $datakredit['jumlah'];
$jumlahsaldo = $jumlahdebit - $jumlahkredit;

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push($data, $row);
}

class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'F4',
  		'orientation'=>'P'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
		//include_once("../config.php");
		$db_host = "localhost";
		$db_name = "sika";
		$db_user = "root";
		$db_pass = "";
		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if(isset($_GET['cari'])){
			$cari1 = $_GET['cari1'];
			$cari2 = $_GET['cari2'];
			$a = empty($_GET['cari1']);
			$b = empty($_GET['cari2']);
			$tanggalAwal = date('m',strtotime($cari1));
			$tahunAwal = date('Y',strtotime($cari1));
			$ceka = $tanggalAwal - 1;
			$perAwal = $tahunAwal."-".$ceka."-31";
			if ($a AND $b) {
				$kreditSaldo = mysqli_query($conn, "SELECT SUM(kredit) AS jum FROM tb_kas WHERE tanggal = '0000-0-0'");
				$debitSaldo = mysqli_query($conn, "SELECT SUM(debit) AS jum FROM tb_kas WHERE tanggal = '0000-0-0'");
				$debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas");
				$kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas");
			}else{
				$kreditSaldo = mysqli_query($conn, "SELECT SUM(kredit) AS jum FROM tb_kas WHERE tanggal BETWEEN '1970-01-01' AND '$perAwal' ");
				$debitSaldo = mysqli_query($conn, "SELECT SUM(debit) AS jum FROM tb_kas WHERE tanggal BETWEEN '1970-01-01' AND '$perAwal' ");
				$debit = mysqli_query($conn, "SELECT SUM(debit) AS jumlah FROM tb_kas where tanggal BETWEEN '$cari1' AND '$cari2'");
				$kredit = mysqli_query($conn, "SELECT SUM(kredit) AS jumlah FROM tb_kas where tanggal BETWEEN '$cari1' AND '$cari2'");
					
			}
			$debitAwalan = mysqli_fetch_array($debitSaldo);
			$kreditAwalan = mysqli_fetch_array($kreditSaldo);
			$datadebit = mysqli_fetch_array($debit);
			$datakredit = mysqli_fetch_array($kredit);
			$jumlahdebit = $datadebit['jumlah'];
			$jumlahkredit = $datakredit['jumlah'];
			$jumlahsaldo = $jumlahdebit - $jumlahkredit;
			$x = $debitAwalan['jum'];
			$y = $kreditAwalan['jum'];
			$z = $x - $y;
			$tot = $z + $jumlahdebit - $jumlahkredit;
		}

		
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		
		//header
		if(isset($_GET['cari'])){
			$cari1 = $_GET['cari1'];
			$tgl1 = date('d-m-Y', strtotime($cari1));
			$cari2 = $_GET['cari2'];
			$tgl2 = date('d-m-Y', strtotime($cari2));
			$a = empty($_GET['cari1']);
			$b = empty($_GET['cari2']);
			if ($a AND $b) {
				$c = "";
				$d = ""; 
			}else{
				$c = $tgl1;
				$d = $tgl2; 
			}
		}
		$this->SetFont("", "B", 15);
		$this->Cell(0, 12, 'SISTEM INFORMASI KEUANGAN REMAJA MASJID', 0, 1,'C');
		$this->Ln(5);
		$this->Cell(0, 12, 'DESA KALIONDO', 0, 1,'C');
		$this->Ln(5);
		$this->Cell(0, 1, "", "B");
		$this->Ln(2);
		$this->Cell(0, 1, "", "B");
		$this->Ln(10);
		$this->SetFont("", "B", 12);
		$this->SetX($left); $this->Cell(0, 10, 'LAPORAN DATA KEUANGAN ', 0, 1,'C');
		$this->Ln(5);
		$this->SetFont("", "B", 9);
		$this->SetX($left); $this->Cell(0, 10, "dari tanggal " .$c . " sampai tanggal " .$d, 0, 1,'C');
		$this->Ln(10);
		$this->Ln(10);
		
		
		$h = 20;
		$left = 40;
		$top = 80;	
		#tableheader
		$this->SetFillColor(200,200,200);	
		$left = $this->GetX();
		$this->Cell(25,$h,'NO',1,0,'L',true);
		$this->SetX($left += 25); $this->Cell(150, $h, 'KETERANGAN', 1, 0, 'C',true);
		$this->SetX($left += 150); $this->Cell(75, $h, 'JENIS', 1, 0, 'C',true);
		$this->SetX($left += 75); $this->Cell(100, $h, 'TANGGAL', 1, 0, 'C',true);
		$this->SetX($left += 100); $this->Cell(95, $h, 'DEBIT', 1, 0, 'C',true);
		$this->SetX($left += 95); $this->Cell(95, $h, 'KREDIT', 1, 1, 'C',true);
		//$this->Ln(20);
		
		$this->SetFont('Arial','',11);
		$this->SetWidths(array(25,150,75,100,95,95));
		$this->SetAligns(array('C','L','C','C','C','C',));
		$no = 1; $this->SetFillColor(255);
		foreach ($this->data as $baris) {
			$tgl = $baris['tanggal'];
			$tanggal = date('d-m-Y', strtotime($tgl));
			$this->Row(
				array($no++, 
				$baris['keterangan'], 
				$baris['jenis'], 
				$tanggal, 
				$baris['debit'], 
				$baris['kredit']
			));
		}

		$this->Ln(15);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, 'Jumlah saldo awal adalah : '.$z, 0, 1,'L');
		$this->Ln(10);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, 'Jumlah debit pada tanggal : ' .$c. ' sampai tanggal : '.$d. ' adalah : '.$jumlahdebit, 0, 1,'L');
		$this->Ln(10);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, 'Jumlah kredit pada tanggal : ' .$c. ' sampai tanggal : '.$d. ' adalah : '.$jumlahkredit, 0, 1,'L');
		$this->Ln(10);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, 'Jumlah saldo akhir pada tanggal : ' .$c. ' sampai tanggal : '.$d. ' adalah : '.$tot, 0, 1,'L');
		$this->Ln(15);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, 'Demikian untuk dapat dipergunakan sebagaimana mestinya. ', 0, 1,'L');
		$this->Ln(30);
		$this->SetFont("", "", 12);
		$this->Cell(0, 12, "Gempol, ".date('d-m-Y'), 0, 1,'L');
		$this->Ln(10);
		$this->Cell(0, 12, 'Ketua Remas', 0, 1,'L');
		$this->Ln(50);
		$this->SetFont("", "B", 12);
		$this->Cell(0, 10, 'M. Muhajirin', 0, 1,'L');
			

	}

	public function printPDF () {
				
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
	
	    $this->rptDetailData();
			    
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	
  	
  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=12*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class




//pilihan
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
