<?php
	include "includes/db.php";
if(isset($_POST["view"])){
// $output = '';
	if($_POST["view"] != ''){
		$update_query="UPDATE products SET state = 1 WHERE status = 'expired'";
		mysqli_query($connection,$update_query);
	}
	$query = "SELECT * FROM products WHERE status='expired'  ORDER BY expiry_date desc limit 5";
	$result=mysqli_query($connection,$query);

	$output = '';
	if(mysqli_num_rows($result) > 0)
	{
		while($row=mysqli_fetch_array($result))
		{
			$product_id=$row['product_id'];
			$brand_id=$row['brand_id'];


		
			$output .='
			<li>
		<a href="single_product.php?p_id='.$row["product_id"].' ">
		<img src="images/'.$row["image"].'" Width="50px">
			
			<strong> expired </strong><br/>
		
			<small><em>'.$row["expiry_date"].'</em></small>
			</a>

			</li>
			<li class ="divider"></li>

			';
		
		}
	}else{
		
		$output.='<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
	}

	
	
	$query_1="SELECT * FROM products WHERE status = 'expired' and state = 0 ";
	$result_1=mysqli_query($connection,$query_1);
	$count=mysqli_num_rows($result_1);
	$data=array(
		 'notification' => $output,
		'unseen_notification' => $count
	);

	echo json_encode($data);
}

?>