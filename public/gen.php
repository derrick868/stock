
<?php
require_once 'includes/db.php';
require_once'fpdf/fpdf.php';

if(isset($_POST['gen'])){

$start_date=$_POST['start_date'];
	$end_date=$_POST['end_date'];
	

	$sql="SELECT * FROM sales WHERE date >='$start_date' AND date <= '$end_date' ";
	$sel_query=mysqli_query($connection,$sql);


class PDF extends FPDF
{
// Page header
function Header()
{
	
	// Logo
	$this->Image('logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(100);
	// Title
	$this->Cell(30,10,'Sales',1,0,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','','14');

$pdf->cell('10','10','ID','1','0','c');
	$pdf->cell('30','10','NAME','1','0','c');
	$pdf->cell('30','10','QUANTITY','1','0','c');
	$pdf->cell('25','10','SIZE','1','0','c');
	$pdf->cell('25','10','UNITS','1','0','c');
	$pdf->cell('25','10','B.PRICE','1','0','c');
	$pdf->cell('25','10','S.PRICE','1','0','c');
	$pdf->cell('25','10','SOLD','1','0','c');
	$pdf->cell('25','10','TOTAL','1','0','c');
	$pdf->cell('25','10','DATE','1','1','c');

$pdf->SetFont('arial','','12');
	while($row=mysqli_fetch_assoc($sel_query)){
		$product_id=$row['product_id'];

		$pdf->cell('10','10',$row['product_id'],'1','0','c');


                    $query="SELECT * FROM products WHERE product_id= $product_id";
                    $select_product=mysqli_query($connection,$query);
                  
                   	$product=mysqli_fetch_array($select_product);
                   	$total_cost=$product['total_cost'];
                   	$pack=$product['product_pack'];
                   	$brand=$product['brand_id'];

                   	$query6 = "SELECT * FROM brands where id = $brand ";
                   	$select_brand=mysqli_query($connection,$query6);
                   	$brand=mysqli_fetch_array($select_brand);

                    		
                    
	$pdf->cell('30','10',$brand['name'],'1','0','c');
	$pdf->cell('30','10',$row['quantity'],'1','0','c');
	$pdf->cell('25','10',$product['product_pack'],'1','0','c');
	$pdf->cell('25','10',$product['units'],'1','0','c');
	$pdf->cell('25','10',$row['cost'],'1','0','c');
	$pdf->cell('25','10',$row['price'],'1','0','c');
	$pdf->cell('25','10',$row['selling_price'],'1','0','c');
	$pdf->cell('25','10',$row['total_sales'],'1','0','c');
	$pdf->cell('25','10',$row['date'],'1','1','c');

	}


					if(isset($_POST['gen'])){
					$start_date=$_POST['start_date'];
					$end_date=$_POST['end_date'];

					$query="SELECT SUM(total_sales) AS total_sales,SUM(expected_sales) AS expected_sales,SUM(quantity) AS quantity,cost AS cost FROM sales WHERE date >= '$start_date' AND date <= '$end_date'";

	$pdf->cell('50','10','Total Purchase(KES)','1','0','c');
	$pdf->cell('50','10','Total Sales(KES)','1','0','c');
	$pdf->cell('50','10','Profit(KES)','1','1','c');


					$sum=mysqli_query($connection,$query);
					while($row=mysqli_fetch_assoc($sum)){
						$quantity=$row['quantity'];
						$cost=$row['cost'];
						$expected_sales=$row['expected_sales'];
						$total_sales=$row['total_sales'];
						$total_purchase=$quantity * $cost;
						$profit=$total_sales - $total_purchase;

	$pdf->cell('50','10',$total_purchase,'1','0','c');
	$pdf->cell('50','10',$total_sales,'1','0','c');
	$pdf->cell('50','10',$profit,'1','1','c');

					}
				
					
				}
	
$pdf->Output();


}



?>